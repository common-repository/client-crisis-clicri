<?php
/*
    "WordPress Plugin Template" Copyright (C) 2016 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This file is part of WordPress Plugin Template for WordPress.

    WordPress Plugin Template is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    WordPress Plugin Template is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database Extension.
    If not, see http://www.gnu.org/licenses/gpl-3.0.html
*/

include_once('clicri_InstallIndicator.php');

class clicri_LifeCycle extends clicri_InstallIndicator {

    public function install() {

        // Initialize Plugin Options
        $this->initOptions();

        // Initialize DB Tables used by the plugin
        $this->installDatabaseTables();

        // Other Plugin initialization - for the plugin writer to override as needed
        $this->otherInstall();

        // Record the installed version
        $this->saveInstalledVersion();

        // To avoid running install() more then once
        $this->markAsInstalled();
    }

    public function uninstall() {
        $this->otherUninstall();
        $this->unInstallDatabaseTables();
        $this->deleteSavedOptions();
        $this->markAsUnInstalled();
    }

    /**
     * Perform any version-upgrade activities prior to activation (e.g. database changes)
     * @return void
     */
    public function upgrade() {
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=105
     * @return void
     */
    public function activate() {
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=105
     * @return void
     */
    public function deactivate() {
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return void
     */
    protected function initOptions() {
    }

    public function addActionsAndFilters() {
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */
    protected function installDatabaseTables() {
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
    }

    /**
     * Override to add any additional actions to be done at install time
     * See: http://plugin.michael-simpson.com/?page_id=33
     * @return void
     */
    protected function otherInstall() {
    }

    /**
     * Override to add any additional actions to be done at uninstall time
     * See: http://plugin.michael-simpson.com/?page_id=33
     * @return void
     */
    protected function otherUninstall() {
    }

    /**
     * Puts the configuration page in the Plugins menu by default.
     * Override to put it elsewhere or create a set of submenus
     * Override with an empty implementation if you don't want a configuration page
     * @return void
     */
    public function addSettingsSubMenuPage() {
        //$this->addSettingsSubMenuPageToPluginsMenu();
        //$this->addSettingsSubMenuPageToSettingsMenu();
        $this->addSettingsSubMenuPageToTopLevelMenu();
    }


    protected function requireExtraPluginFiles() {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }

    /**
     * @return string Slug name for the URL to the Setting page
     * (i.e. the page for setting options)
     */
    protected function getSettingsSlug() {
        return get_class($this) . 'Settings';
    }

    protected function addSettingsSubMenuPageToPluginsMenu() {
        $this->requireExtraPluginFiles();
        $displayName = $this->getPluginDisplayName();
        add_menu_page('plugins.php',
                         $displayName,
                         $displayName,
                         'manage_options',
                         $this->getSettingsSlug(),
                         array(&$this, 'settingsPage'));
    }
    
    protected function addSettingsSubMenuPageToTopLevelMenu() {
		$this->requireExtraPluginFiles();
		$displayName = $this->getPluginDisplayName();
		$menuName = (__('Crisis', 'clicri'));
		$icon_path = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHdpZHRoPSI1MDBweCIgaGVpZ2h0PSI1MDBweCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDUwMCA1MDAiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxwYXRoIGZpbGw9Im5vbmUiIGQ9Ik03LjE0NCwyNTIuMjgzYzAtMTM1LjI2LDExMC4wNDEtMjQ1LjMwNCwyNDUuMzAyLTI0NS4zMDRjMTM1LjI2LDAsMjQ1LjMwMywxMTAuMDQzLDI0NS4zMDMsMjQ1LjMwNFMzODcuNzA1LDQ5Ny41ODgsMjUyLjQ0NSw0OTcuNTg4QzExNy4xODUsNDk3LjU4OCw3LjE0NCwzODcuNTQzLDcuMTQ0LDI1Mi4yODN6IE00ODIuMTI1LDI1Mi4yODNjMC0xMjYuNjQ3LTEwMy4wMzUtMjI5LjY4LTIyOS42OC0yMjkuNjhjLTEyNi42NDYsMC0yMjkuNjc5LDEwMy4wMzUtMjI5LjY3OSwyMjkuNjhjMCwxMjYuNjQ1LDEwMy4wMzMsMjI5LjY4LDIyOS42NzksMjI5LjY4QzM3OS4wOSw0ODEuOTY0LDQ4Mi4xMjUsMzc4LjkzLDQ4Mi4xMjUsMjUyLjI4M3oiLz48Zz48Zz48cGF0aCBmaWxsPSJub25lIiBkPSJNMTkyLjcyOSwyNTIuMzEyYzAtMC4yMzgsMC0wLjQ2MywwLTAuNjk5YzAtNDMuMzg0LDMwLjAxOC04My44MzMsODIuNjE3LTExMS4wNTlsNC44MzctMy40MjNMMTkwLjg0MSwyMS44MzdoLTExLjkzOEwyNjYuNjMxLDEzNGMtNTIuNzUxLDI4Ljg5NC04MS45MDEsNzEuOTctODEuOTAxLDExNy42MWMwLDAuMjU0LDAsMC41MTcsMCwwLjc3YzAsMC4wMTYtMC43OTIsMC40NTktMC43OTIsMC40NTloOS41NTJDMTkzLjQ4OSwyNTIuODM4LDE5Mi43MjksMjUyLjM1LDE5Mi43MjksMjUyLjMxMnoiLz48L2c+PGc+PHBhdGggZmlsbD0ibm9uZSIgZD0iTTE5Mi43MjksMjUxLjczOGMwLDAuMjM4LDAsMC40NjgsMCwwLjcwMWMwLDQzLjY5MSwzMC4wMTgsODQuNDIsODIuNjE3LDExMS44M2w0LjgzNywzLjAwOGwtODkuMzc4LDExNS42Nmw3NS44MDgtMTEyLjUwNGMtNTIuNzUxLTI5LjA5NC04MS44ODQtNzIuMDMxLTgxLjg4NC0xMTcuOTg4YzAtMC4yNTgsMC0wLjUyMSwwLTAuNzc1YzAtMC4wMTQtMC43OTIsMS4xNjgtMC43OTIsMS4xNjhoOS41NTJDMTkzLjQ4OSwyNTIuODM4LDE5Mi43MjksMjUxLjY5OSwxOTIuNzI5LDI1MS43Mzh6Ii8+PHBhdGggZmlsbD0ibm9uZSIgZD0iTTE0Ljk1NSwyNTIuMjgzQzkuNDM5LDQxOC40OTIsMTkwLjg0NCw0ODIuOTM4LDE5MC44NDQsNDgyLjkzOGM3Ni4wMjUtMTEyLjUwMiw3Ni4wMjUtMTEyLjUwMiw3Ni4wMjUtMTEyLjUwMnMtODUuMDU2LTUxLjgxOC04MS4xNDktMTI0LjAzMWMzLjkwNi03Mi4yMTEsODEuMTQ5LTExMi4zLDgxLjE0OS0xMTIuM0wxODMuOTM4LDI4LjQ2MkMxMjQuMzI3LDYzLjk4NSwyMC40NjcsODYuMDczLDE0Ljk1NSwyNTIuMjgzeiIvPjwvZz48L2c+PC9zdmc+';
		add_menu_page($displayName,
		$menuName,
		'manage_options',
		$this->getSettingsSlug(),
		array(&$this, 'settingsPage')
		, $icon_path
		//, $menu_position
		);
	}

    protected function addSettingsSubMenuPageToSettingsMenu() {
        $this->requireExtraPluginFiles();
        $displayName = $this->getPluginDisplayName();
        add_options_page($displayName,
                         $displayName,
                         'manage_options',
                         $this->getSettingsSlug(),
                         array(&$this, 'settingsPage'));
    }

    /**
     * @param  $name string name of a database table
     * @return string input prefixed with the WordPress DB table prefix
     * plus the prefix for this plugin (lower-cased) to avoid table name collisions.
     * The plugin prefix is lower-cases as a best practice that all DB table names are lower case to
     * avoid issues on some platforms
     */
    protected function prefixTableName($name) {
        global $wpdb;
        return $wpdb->prefix .  strtolower($this->prefix($name));
    }


    /**
     * Convenience function for creating AJAX URLs.
     *
     * @param $actionName string the name of the ajax action registered in a call like
     * add_action('wp_ajax_actionName', array(&$this, 'functionName'));
     *     and/or
     * add_action('wp_ajax_nopriv_actionName', array(&$this, 'functionName'));
     *
     * If have an additional parameters to add to the Ajax call, e.g. an "id" parameter,
     * you could call this function and append to the returned string like:
     *    $url = $this->getAjaxUrl('myaction&id=') . urlencode($id);
     * or more complex:
     *    $url = sprintf($this->getAjaxUrl('myaction&id=%s&var2=%s&var3=%s'), urlencode($id), urlencode($var2), urlencode($var3));
     *
     * @return string URL that can be used in a web page to make an Ajax call to $this->functionName
     */
    public function getAjaxUrl($actionName) {
        return admin_url('admin-ajax.php') . '?action=' . $actionName;
    }

}
