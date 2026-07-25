<?php

namespace App\Services;

class PermissionService
{
    /**
     * Check if user can access admin-only features
     */
    public static function canAccessAdminFeatures()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Check if user can access owner/manager features
     */
    public static function canAccessManagerFeatures()
    {
        return auth()->check() && auth()->user()->hasFullAccess();
    }

    /**
     * Check if user can record payment
     */
    public static function canRecordPayment()
    {
        return auth()->check() && auth()->user()->hasFullAccess();
    }

    /**
     * Check if user can export reports
     */
    public static function canExportReports()
    {
        return auth()->check() && auth()->user()->hasFullAccess();
    }

    /**
     * Check if user can manage users
     */
    public static function canManageUsers()
    {
        return auth()->check() && auth()->user()->hasFullAccess();
    }

    /**
     * Check if user can delete records
     */
    public static function canDeleteRecords()
    {
        return auth()->check() && auth()->user()->hasFullAccess();
    }

    /**
     * Get list of roles
     */
    public static function getRoles()
    {
        return [
            'Admin' => 'Administrator (Akses Terbatas)',
            'Manager' => 'Manager / Owner (Akses Penuh)',
            'Sales' => 'Sales (Akses Terbatas)',
        ];
    }

    /**
     * Get human-readable role name
     */
    public static function getRoleName($role)
    {
        $roles = self::getRoles();
        return $roles[$role] ?? ucfirst($role);
    }
}
