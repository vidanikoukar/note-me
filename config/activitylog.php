<?php

return [

    /*
     * If set to false, no activities will be saved to the database.
     */
    'enabled' => env('ACTIVITY_LOG_ENABLED', true),

    /*
     * When running the application in testing mode, we will not log any activities.
     * You can override this behaviour by setting this parameter to true.
     */
    'log_on_testing' => false,

    /*
     * When set to true, the subject returns soft deleted models.
     */
    'subject_returns_soft_deleted_models' => false,

    /*
     * This model will be used to log activities.
     * It should be implements the Spatie\Activitylog\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */
    'table_name' => 'activity_log',

    /*
     * This is the database connection that will be used by the migration and
     * the Activity model shipped with this package. In case it's not set
     * Laravel's database.default will be used instead.
     */
    'database_connection' => env('ACTIVITY_LOG_DB_CONNECTION'),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 365,

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     */
    'default_auth_driver' => null,

    /*
     * If set to true, the subject will be saved delightful.
     */
    'log_subject_changes' => false,

    /*
     * If set to true, the causer will be saved delightful.
     */
    'log_causer_changes' => false,
];
