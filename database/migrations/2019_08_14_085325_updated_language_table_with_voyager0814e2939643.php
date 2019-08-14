<?php

use Illuminate\Database\Migrations\Migration;
use TCG\Voyager\Database\DatabaseUpdater;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Database\Types\Type;

class UpdatedLanguageTableWithVoyager0814e2939643 extends Migration
{
    public function __construct()
    {
        Type::registerCustomPlatformTypes();
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Generated only to work with Voyager
        // upHash=38e45f9c5f3f2a493cb504b308371794
        DatabaseUpdater::update(
            [
              "name" => "language",
              "oldName" => "language",
              "columns" => [
                "0" => [
                  "name" => "id",
                  "type" => [
                    "name" => "integer",
                    "category" => "Numbers",
                    "default" => [
                      "type" => "number",
                      "step" => "any",
                      ],
                    ],
                  "default" => null,
                  "notnull" => "1",
                  "length" => null,
                  "precision" => "10",
                  "scale" => "0",
                  "fixed" => "",
                  "unsigned" => "1",
                  "autoincrement" => "1",
                  "columnDefinition" => null,
                  "comment" => null,
                  "oldName" => "id",
                  "null" => "NO",
                  "extra" => "auto_increment",
                  "composite" => "",
                  ],
                "1" => [
                  "name" => "ids",
                  "type" => [
                    "name" => "varchar",
                    "category" => "Strings",
                    ],
                  "default" => null,
                  "notnull" => "",
                  "length" => "250",
                  "precision" => "10",
                  "scale" => "0",
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "columnDefinition" => null,
                  "comment" => null,
                  "collation" => "utf8mb4_general_ci",
                  "oldName" => "ids",
                  "null" => "YES",
                  "extra" => "",
                  "composite" => "",
                  ],
                "2" => [
                  "name" => "phrase",
                  "type" => [
                    "name" => "varchar",
                    "category" => "Strings",
                    ],
                  "default" => null,
                  "notnull" => "1",
                  "length" => "150",
                  "precision" => "10",
                  "scale" => "0",
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "columnDefinition" => null,
                  "comment" => null,
                  "collation" => "utf8_general_ci",
                  "oldName" => "phrase",
                  "null" => "NO",
                  "extra" => "",
                  "composite" => "",
                  ],
                "3" => [
                  "name" => "en",
                  "type" => [
                    "name" => "text",
                    "category" => "Strings",
                    "notSupportIndex" => "1",
                    "default" => [
                      "disabled" => "1",
                      ],
                    ],
                  "default" => null,
                  "notnull" => "",
                  "length" => "65535",
                  "precision" => "10",
                  "scale" => "0",
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "columnDefinition" => null,
                  "comment" => null,
                  "collation" => "utf8_general_ci",
                  "oldName" => "en",
                  "null" => "YES",
                  "extra" => "",
                  "composite" => "",
                  ],
                "4" => [
                  "name" => "ar",
                  "type" => [
                    "name" => "text",
                    "category" => "Strings",
                    "notSupportIndex" => "1",
                    "default" => [
                      "disabled" => "1",
                      ],
                    ],
                  "default" => null,
                  "notnull" => "",
                  "length" => "65535",
                  "precision" => "10",
                  "scale" => "0",
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "columnDefinition" => null,
                  "comment" => null,
                  "collation" => "utf8_general_ci",
                  "oldName" => "ar",
                  "null" => "YES",
                  "extra" => "",
                  "composite" => "",
                  ],
                "5" => [
                  "name" => "created_at",
                  "oldName" => "",
                  "type" => [
                    "name" => "timestamp",
                    "category" => "Date and Time",
                    ],
                  "length" => null,
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "notnull" => "",
                  "default" => null,
                  ],
                "6" => [
                  "name" => "updated_at",
                  "oldName" => "",
                  "type" => [
                    "name" => "timestamp",
                    "category" => "Date and Time",
                    ],
                  "length" => null,
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "notnull" => "",
                  "default" => null,
                  ],
                "7" => [
                  "name" => "deleted_at",
                  "oldName" => "",
                  "type" => [
                    "name" => "timestamp",
                    "category" => "Date and Time",
                    ],
                  "length" => null,
                  "fixed" => "",
                  "unsigned" => "",
                  "autoincrement" => "",
                  "notnull" => "",
                  "default" => null,
                  ],
                ],
              "indexes" => [
                "0" => [
                  "name" => "ids",
                  "oldName" => "ids",
                  "columns" => [
                    "0" => "ids",
                    ],
                  "type" => "UNIQUE",
                  "isPrimary" => "",
                  "isUnique" => "1",
                  "isComposite" => "",
                  "flags" => [
                    ],
                  "options" => [
                    "lengths" => [
                      "0" => null,
                      ],
                    ],
                  "table" => "language",
                  ],
                "1" => [
                  "name" => "phrase",
                  "oldName" => "phrase",
                  "columns" => [
                    "0" => "phrase",
                    ],
                  "type" => "UNIQUE",
                  "isPrimary" => "",
                  "isUnique" => "1",
                  "isComposite" => "",
                  "flags" => [
                    ],
                  "options" => [
                    "lengths" => [
                      "0" => null,
                      ],
                    ],
                  "table" => "language",
                  ],
                "2" => [
                  "name" => "PRIMARY",
                  "oldName" => "PRIMARY",
                  "columns" => [
                    "0" => "id",
                    ],
                  "type" => "PRIMARY",
                  "isPrimary" => "1",
                  "isUnique" => "1",
                  "isComposite" => "",
                  "flags" => [
                    ],
                  "options" => [
                    "lengths" => [
                      "0" => null,
                      ],
                    ],
                  "table" => "language",
                  ],
                ],
              "primaryKeyName" => "primary",
              "foreignKeys" => [
                ],
              "options" => [
                ],
              ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

        