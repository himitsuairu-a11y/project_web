<?php

namespace App\Services;

use App\Models\Cat;
use App\Enums\CatStatus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CatService
{
    public function getFilteredCats(?string $breed, ?int $age)
    {
        $query = Cat::query()->where('status', CatStatus::AVAILABLE->value);

        if (!empty($breed)) {
            $query->where('breed', 'like', '%' . $breed . '%');
        }

        if (!is_null($age)) {
            $query->where('age_in_months', $age);
        }

        return $query->paginate(6)->withQueryString();
    }

    public function getAllCats()
    {
        return Cat::latest()->get();
    }

    public function storeCat(array $data)
    {
        if (isset($data['photos']) && is_array($data['photos'])) {
            $paths = [];
            foreach ($data['photos'] as $photo) {
                if ($photo instanceof UploadedFile) {
                    $paths[] = $this->handlePhotoUpload($photo);
                }
            }
            if (!empty($paths)) {
                $data['photo_path'] = $paths[0];
                $data['photos'] = $paths;
            }
        }

        return Cat::create($data);
    }

    public function updateCat(Cat $cat, array $data)
    {
        $existingPhotos = $cat->photos ?? [];
        if ($cat->photo_path && !in_array($cat->photo_path, $existingPhotos)) {
            array_unshift($existingPhotos, $cat->photo_path);
        }

        // Process deletions
        if (isset($data['delete_photos']) && is_array($data['delete_photos'])) {
            foreach ($data['delete_photos'] as $del) {
                Storage::disk('public')->delete($del);
                $existingPhotos = array_values(array_filter($existingPhotos, fn($p) => $p !== $del));
            }
        }
        unset($data['delete_photos']);

        // Process additions
        if (isset($data['photos']) && is_array($data['photos'])) {
            $newPaths = [];
            foreach ($data['photos'] as $photo) {
                if ($photo instanceof UploadedFile) {
                    $newPaths[] = $this->handlePhotoUpload($photo);
                }
            }
            $existingPhotos = array_merge($existingPhotos, $newPaths);
        }

        if (!empty($existingPhotos)) {
            $data['photo_path'] = $existingPhotos[0];
            $data['photos'] = $existingPhotos;
        } else {
            $data['photo_path'] = null;
            $data['photos'] = [];
        }

        $cat->update($data);

        return $cat;
    }

    public function deleteCat(Cat $cat)
    {
        if ($cat->photos) {
            foreach ($cat->photos as $oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } elseif ($cat->photo_path) {
            Storage::disk('public')->delete($cat->photo_path);
        }

        return $cat->delete();
    }

    private function handlePhotoUpload(UploadedFile $photo): string
    {
        if (!extension_loaded('gd')) {
            // Fallback if GD is missing on user's local setup
            return $photo->store('cats', 'public');
        }

        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($photo->getPathname());
            
            // Resize down to max width 800px while maintaining aspect ratio
            $image->scaleDown(width: 800);
            
            // Encode to JPEG format with 80% quality
            $encoded = $image->toJpeg(80);
            
            $filename = 'cats/' . uniqid() . '_' . time() . '.jpg';
            Storage::disk('public')->put($filename, $encoded->toString());
            
            return $filename;
        } catch (\Exception $e) {
            // Ultimate fallback
            return $photo->store('cats', 'public');
        }
    }
}
