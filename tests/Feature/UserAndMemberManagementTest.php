<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserAndMemberManagementTest extends TestCase
{
    public function test_user_roles_and_helpers(): void
    {
        $superadmin = User::where('role', User::ROLE_SUPERADMIN)->first() ?? User::factory()->create(['role' => User::ROLE_SUPERADMIN]);
        $dosen = User::where('role', User::ROLE_DOSEN)->first() ?? User::factory()->create(['role' => User::ROLE_DOSEN]);
        $aslab = User::where('role', User::ROLE_ASLAB)->first() ?? User::factory()->create(['role' => User::ROLE_ASLAB]);
        $himatika = User::where('role', User::ROLE_HIMATIKA)->first() ?? User::factory()->create(['role' => User::ROLE_HIMATIKA]);

        $this->assertTrue($superadmin->isSuperAdmin());
        $this->assertFalse($dosen->isSuperAdmin());
        $this->assertTrue($dosen->isDosen());
        $this->assertTrue($aslab->isAslab());
        $this->assertTrue($himatika->isHimatika());
    }

    public function test_avatar_and_photo_url_accessors_and_fallbacks(): void
    {
        $user = User::factory()->create([
            'name' => 'Bima Testing',
            'role' => User::ROLE_SUPERADMIN,
            'avatar' => null,
        ]);

        // Default fallback avatar URL contains user's name
        $this->assertStringContainsString('ui-avatars.com', $user->avatar_url);
        $this->assertStringContainsString('Bima+Testing', $user->avatar_url);
        $this->assertNull($user->getFilamentAvatarUrl());

        // When avatar is set
        $user->avatar = 'avatars/profile.png';
        $user->save();

        $this->assertStringContainsString('storage/avatars/profile.png', $user->avatar_url);
        $this->assertStringContainsString('storage/avatars/profile.png', $user->getFilamentAvatarUrl());

        // Member photo fallback
        $member = new Member([
            'nama' => 'John Doe Lab',
            'foto' => null,
        ]);

        $this->assertStringContainsString('ui-avatars.com', $member->foto_url);
        $this->assertStringContainsString('John+Doe+Lab', $member->foto_url);

        $member->foto = 'members/johndoe.jpg';
        $this->assertStringContainsString('storage/members/johndoe.jpg', $member->foto_url);
    }
}
