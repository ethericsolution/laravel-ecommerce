<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.analytics_code', null);
    }

    public function down(): void
    {
        $this->migrator->delete('general.analytics_code');
    }
};
