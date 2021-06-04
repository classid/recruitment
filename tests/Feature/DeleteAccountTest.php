<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Features;
use Tests\TestCase;

class DeleteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_accounts_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return static::markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        static::assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return static::markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = User::factory()->create());

        $response = $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        static::assertNotNull($user->fresh());
    }
}
