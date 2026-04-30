<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            if ($this->indexExists('contacts_contact_unique')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->dropUnique('contacts_contact_unique');
                });
            }

            if ($this->indexExists('contacts_email_unique')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->dropUnique('contacts_email_unique');
                });
            }

            Schema::table('contacts', function (Blueprint $table) {
                if (! $this->indexExists('contacts_contact_index')) {
                    $table->index('contact');
                }
                if (! $this->indexExists('contacts_email_index')) {
                    $table->index('email');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() !== 'sqlite') {
            if ($this->indexExists('contacts_contact_index')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->dropIndex(['contact']);
                });
            }

            if ($this->indexExists('contacts_email_index')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->dropIndex(['email']);
                });
            }

            if (! $this->indexExists('contacts_contact_unique')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->unique('contact');
                });
            }

            if (! $this->indexExists('contacts_email_unique')) {
                Schema::table('contacts', function (Blueprint $table) {
                    $table->unique('email');
                });
            }
        }
    }

    private function indexExists(string $indexName): bool
    {
        $databaseName = DB::getDatabaseName();

        return DB::table('information_schema.statistics')
            ->where('table_schema', $databaseName)
            ->where('table_name', 'contacts')
            ->where('index_name', $indexName)
            ->exists();
    }
};
