<?php


include_once('clicri_LifeCycle.php');

class clicri_Plugin extends clicri_LifeCycle {

    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return array of option meta data.
     */
    public function getOptionMetaData() {
        //  http://plugin.michael-simpson.com/?page_id=31
        return array(
            //'_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'Active' => array(__('Activate Crisis Mode','clicri'),'false','true'),
            'HeaderText' => array(__('HeaderText','clicri')),
            'BodyText' => array(__('BodyText','clicri')),
            'ContactInfo' => array(__('Use Custom Template', 'clicri'),'false','true'),
            'ShowPostID' => array(__('I like this awesome plugin', 'my-awesome-plugin'), 'false', 'true'),
            'CanDoSomething' => array(__('Which user role can do something', 'my-awesome-plugin'),
                                        'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone')
        );
    }

    protected function getOptionValueI18nString($optionValue) {
        $i18nValue = parent::getOptionValueI18nString($optionValue);
        return $i18nValue;
    }

    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'Client Crisis (CliCri)';
    }

    protected function getMainPluginFileName() {
        return 'clicri.php';
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
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
        //            `id` INTEGER NOT NULL");
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }


    /**
     * Perform actions when upgrading from version X to version Y
     * See: http://plugin.michael-simpson.com/?page_id=35
     * @return void
     */
    public function upgrade() {
    }

    public function addActionsAndFilters() {

        // Add options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));

        // Example adding a script & style just for the options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        //        if (strpos($_SERVER['REQUEST_URI'], $this->getSettingsSlug()) !== false) {
        //            wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
        //            wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        }

		

        // Add Actions & Filters
        // http://plugin.michael-simpson.com/?page_id=37


        // Adding scripts & styles to all pages
        // Examples:
        //        wp_enqueue_script('jquery');
        //        wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));
        //        wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));
		
		function replaceContent() {
			die;
		}
		
		function blockPage() {
			
			$isActive = get_option('clicri_Plugin_Active');
			
			if ($isActive == 'true') {
				
					$template = plugin_dir_path( __FILE__ ) . 'clicri_template.php';
					return $template;
				
			} 
						
			/*if ($this->Active() == 'Yes') {
				
			}*/
	    
    	}
		
		$isActive = get_option('clicri_Plugin_Active');
		
		if ($isActive == 'true') {
			add_filter( 'template_include', 'blockPage' );
		}
		

        // Register short codes
        // http://plugin.michael-simpson.com/?page_id=39

		add_shortcode('clipri-header', array($this, 'doHeaderShortcode'));
		add_shortcode('clipri-body', array($this, 'doBodyShortcode'));

        // Register AJAX hooks
        // http://plugin.michael-simpson.com/?page_id=41

    }
    
    public function doHeaderShortcode() {
	    return get_option('clicri_Plugin_HeaderText');
	}
	
	public function doBodyShortcode() {
		$content = get_option('clicri_Plugin_BodyText');
		$stripcontent = stripslashes_deep($content);
	    return $stripcontent;
	}


}
