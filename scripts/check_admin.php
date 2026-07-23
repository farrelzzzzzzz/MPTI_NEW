<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Schema;

if (!Schema::hasColumn('users', 'role')) {
    echo "NO_ROLE_COLUMN\n";
    exit(0);
}

$user = User::where('email', 'admin@rytravel.com')->first();
if (!$user) {
    echo "NO_ADMIN_USER\n";
    exit(0);
}

echo "ID=" . $user->id . "\n";
echo "EMAIL=" . $user->email . "\n";
echo "ROLE=" . $user->role . "\n";
echo "LOCKED=" . ($user->isLocked() ? '1' : '0') . "\n";
echo "PASSWORD_HASH=" . $user->password . "\n";
$testPassword = 'admin123';
echo "CHECK_ADMIN123=" . (Illuminate\Support\Facades\Hash::check($testPassword, $user->password) ? 'OK' : 'FAIL') . "\n";
