<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TwoFactorAuthenticationSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_two_factor_authentication_can_be_enabled()
    {
        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => time()]);

        $response = $this->post('/user/two-factor-authentication');

        static::assertNotNull($user->fresh()->two_factor_secret);
        static::assertCount(8, $user->fresh()->recoveryCodes());
    }

    public function test_recovery_codes_can_be_regenerated()
    {
        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => time()]);

        $this->post('/user/two-factor-authentication');
        $this->post('/user/two-factor-recovery-codes');

        $user = $user->fresh();

        $this->post('/user/two-factor-recovery-codes');

        static::assertCount(8, $user->recoveryCodes());
        static::assertCount(8, array_diff($user->recoveryCodes(), $user->fresh()->recoveryCodes()));
    }

    public function test_two_factor_authentication_can_be_disabled()
    {
        $this->actingAs($user = User::factory()->create());

        $this->withSession(['auth.password_confirmed_at' => time()]);

        $this->post('/user/two-factor-authentication');

        static::assertNotNull($user->fresh()->two_factor_secret);

        $this->delete('/user/two-factor-authentication');

        static::assertNull($user->fresh()->two_factor_secret);
    }
}
