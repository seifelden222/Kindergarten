<?php

use App\Models\Payment;
use App\Models\User;

it('stores a child in the database for the authenticated guardian', function () {
    $guardian = User::factory()->create([
        'role' => 'guardian',
    ]);

    $this->actingAs($guardian)
        ->post(route('parent.addchild.store'), [
            'first_name' => 'ليلى',
            'last_name' => 'أحمد',
            'email' => 'child-login@example.com',
            'gender' => 'female',
            'birth_date' => '2021-05-10',
            'level_name' => 'تمهيدي أول (أ)',
            'classroom_name' => 'الفصل أ',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'allergies' => 'حساسية من الفول السوداني',
            'chronic_diseases' => 'الربو',
            'medications' => 'بخاخ عند الحاجة',
        ])
        ->assertRedirect(route('parent.addchild'));

    $child = User::query()
        ->where('guardian_id', $guardian->id)
        ->where('role', 'child')
        ->first();

    expect($child)->not->toBeNull();
    expect($child?->name)->toBe('ليلى أحمد');
    expect($child?->email)->toBe('child-login@example.com');
    expect($child?->age)->toBeInt();
    expect($child?->level_name)->toBe('تمهيدي أول (أ)');
    expect($child?->classroom_name)->toBe('الفصل أ');
    expect($child?->allergies)->toBe('حساسية من الفول السوداني');
});

it('stores a payment in the database for the authenticated guardian', function () {
    $guardian = User::factory()->create([
        'role' => 'guardian',
    ]);

    $child = User::factory()->create([
        'role' => 'child',
        'guardian_id' => $guardian->id,
    ]);

    $this->actingAs($guardian)
        ->post(route('parent.payment.store'), [
            'child_id' => $child->id,
            'amount' => 3050,
            'payment_method' => 'fawry',
            'notes' => 'دفعة شهر أبريل',
        ])
        ->assertRedirect(route('parent.payment'));

    $payment = Payment::query()->first();

    expect($payment)->not->toBeNull();
    expect((int) $payment?->guardian_id)->toBe($guardian->id);
    expect((int) $payment?->child_id)->toBe($child->id);
    expect((float) $payment?->amount)->toBe(3050.0);
    expect($payment?->payment_method)->toBe('fawry');
    expect($payment?->status)->toBe('paid');
});
