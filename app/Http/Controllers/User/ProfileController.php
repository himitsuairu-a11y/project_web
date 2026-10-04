<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'job' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'id_card' => 'nullable|image|max:2048',
            'salary_slip' => 'nullable|image|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'job' => $validated['job'],
            'salary' => $validated['salary'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('id_card')) {
            if ($user->id_card_path) {
                Storage::disk('public')->delete($user->id_card_path);
            }
            $data['id_card_path'] = $request->file('id_card')->store('documents/id_cards', 'public');
        }

        if ($request->hasFile('salary_slip')) {
            if ($user->salary_slip_path) {
                Storage::disk('public')->delete($user->salary_slip_path);
            }
            $data['salary_slip_path'] = $request->file('salary_slip')->store('documents/salary_slips', 'public');
        }

        $user->update($data);

        return redirect()->route('user.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
