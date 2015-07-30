<?php 

add_action('admin_menu', 'ad_create_menu');

function ad_create_menu() {

	add_submenu_page('adrotate','Ad Settings', 'Assign Ads', 'manage_options', __FILE__, 'ad_settings_page');
	add_action( 'admin_init', 'register_mysettings' );
}

function register_mysettings() {
	register_setting( 'ad-settings-group', 'assigned_ad' );
    add_settings_section('ad_main', '', 'section_text', 'ad-plugin');
    add_settings_field('ad_settings_field', '', 'ad_fields', 'ad-plugin', 'ad_main');

}

function section_text() {
    echo '<p>The first ad slot will appear with all articles, aligned with the fifth paragraph.';
    echo 'The second ad slot will only appear in articles of 1800 words or more. </p>';
}


function ad_fields() {
    $options = get_option('assigned_ad');

    global $wpdb;
    $single_ads = $wpdb->get_results("SELECT id, title FROM wp_adrotate");
    $groups = $wpdb->get_results("SELECT id, name FROM wp_adrotate_groups")?>
    </td></tr></tbody></table>
    <div class='metabox-holder'>
	    <div class='postbox-container' style='width: 49%; padding-right:.5%;'>
		    <div class='postbox'>
		    	<h3 class='hndle ui-sortable-handle'><span>Primary Ad Slot</span></h3>
		    		<div class='inside'>
		    			<select name='assigned_ad[type1]' id='primary_type'>
		    				<?php if ($options['type1'] == 'single') {
		    					echo "<option value='single' selected='selected'>Single Ad</option>";
		    					echo "<option value='group'>Ad Group</option>";
		    				} else {
		    					echo "<option value='single'>Single Ad</option>";
		    					echo "<option value='group'  selected='selected'>Ad Group</option>";
		    				}?>

		    			</select>
		    			<select name='assigned_ad[primary]' class='ad_options'>
		    				<?php 
		    				 foreach($single_ads as $row) {
		    					if($row->id == $options['primary'] && $options['type1'] == 'single'){
		    						echo "<option class ='single' selected ='selected' value='".$row->id."'>".$row->title."</option>";
		    					} else { 
		    						echo "<option class='single' value='".$row->id."'>".$row->title."</option>";
		    					}
		    				  }
		    				  foreach($groups as $row) {
		    					if($row->id == $options['primary'] && $options['type1'] == 'group'){
		    						echo "<option class ='group' selected ='selected' value='".$row->id."'>".$row->name."</option>";
		    					} else { 
		    						echo "<option class='group' value='".$row->id."'>".$row->name."</option>";
		    					}
		    				  }
		    				  if($options['primary'] == 0) {
		    				  	echo "<option value='0' selected='selected'>No Ad</option>";
		    				  } else {
		    				  	echo "<option value='0'>No Ad</option>";
		    				  }?>
		    			</select>
		    		</div>
		    	
		    </div>
		    
	    </div>
	    <div class='postbox-container' style='width: 49%; padding-left:.5%;'>
		    <div class='postbox'>
		    	<h3 class='hndle ui-sortable-handle'><span>Secondary Ad Slot</span></h3>
		    		<div class='inside'>
		    			<select name='assigned_ad[type2]' id='secondary_type'>
		    				<?php if ($options['type2'] == 'single') {
		    					echo "<option value='single' selected='selected'>Single Ad</option>";
		    					echo "<option value='group'>Ad Group</option>";
		    				} else {
		    					echo "<option value='single'>Single Ad</option>";
		    					echo "<option value='group'  selected='selected'>Ad Group</option>";
		    				}?>
		    			</select>
		    			<select name='assigned_ad[secondary]' class='ad_options'>
		    				<?php 
		    				 foreach($single_ads as $row) {
		    					if($row->id == $options['secondary'] && $options['type2'] == 'single'){
		    						echo "<option class ='single' selected ='selected' value='".$row->id."'>".$row->title."</option>";
		    					} else { 
		    						echo "<option class='single' value='".$row->id."'>".$row->title."</option>";
		    					}
		    				  }
		    				  foreach($groups as $row) {
		    					if($row->id == $options['secondary'] && $options['type2'] == 'group'){
		    						echo "<option class ='group' selected ='selected' value='".$row->id."'>".$row->name."</option>";
		    					} else { 
		    						echo "<option class='group' value='".$row->id."'>".$row->name."</option>";
		    					}
		    				  }
		    				  if($options['secondary'] == 0) {
		    				  	echo "<option value='0' selected='selected'>No Ad</option>";
		    				  } else {
		    				  	echo "<option value='0'>No Ad</option>";
		    				  }
		    				  ?>
		    			</select>
		    		</div>
		    </div>
	    </div>

	    <div class="postbox-container" style='width:100%;'>
	    	Select categories for ad to appear:</br></br>
    		<div class="postbox">
		    	<div style="overflow:scroll; height:300px; padding:20px; border-top: 1px solid #f0f0f0;">
				    		
				    		<ul>
				    			<?php if(isset($options['category1'][1001])){ ?>
				    				<li style='display:block; margin:10px'><input class="all_cat" type="checkbox" value="all_categories" name='assigned_ad[category1][1001]' checked/>All Categories</li>
				    			<?php } else { ?>
				    				<li style='display:block; margin:10px'><input class="all_cat" type="checkbox" value="all_categories" name='assigned_ad[category1][1001]'/>All Categories</li>
				    		    <?php }
				    		
				    			$cats = get_categories(array('orderby' => 'term_group')); 
				    			foreach($cats as $index=>$category) {
				    				$tabbed = "";
				    				if($category->parent != 0) {
				    					$tabbed = " style='margin-left:20px'";
				    				}
				    				if(isset($options['category1'][$index]) || isset($options['category1'][1001])) {
				    					echo "<li style='display:block; margin:10px;'><input type='checkbox' value ='".$category->name. "' name='assigned_ad[category1][".$index."]' checked".$tabbed."/>";
				    				}else {
				    					echo "<li style='display:block; margin:10px;'><input type='checkbox' value ='".$category->name. "' name='assigned_ad[category1][".$index."]'".$tabbed."/>";
				    				}
				    				echo $category->name;
				    				echo "</br></li>";
				    			}
				    			
				    		?>
				    	</ul>
				</div>
			</div>
		</div></br>
    </div>

    <table style="display:none;"><tbody><tr><td>
    <script>
    (function($) {
    	
    	
        if($('#primary_type').val() == 'single'){
    		$('#primary_type').next('.ad_options').find('.group').hide();
    	} else {
    		$('#primary_type').next('.ad_options').find('.group').hide();
    	}

    	if($('#secondary_type').val() == 'single'){
    		$('#secondary_type').next('.ad_options').find('.group').hide();
    	} else {
    		$('#secondary_type').next('.ad_options').find('.group').hide();
    	}


    	$('#primary_type').change(hideExtra);
    	$('#secondary_type').change(hideExtra);
    	
    	function hideExtra(){

    		var type = $(this).val();
    		var option = $(this).next('.ad_options');
    		if (type == 'single') {
    			option.find('.group').hide().removeAttr('selected');
    			option.find('.single').show();
    			option.find('.single:first-of-type').attr('selected', 'selected');    			
	    		
	    	} else {
	    		option.find('.single').hide().removeAttr('selected');
	    		option.find('.group').show();
	    		option.find('.group').attr('selected', 'selected');
	    		
	    	}	
    	}

    	$('.all_cat').change(function(){
    		if(this.checked) {
		        $('input[type=checkbox]').attr('checked','true');
		    } 
    	})


    })( jQuery );

    </script>
    <?php
}

function ad_settings_page() {
?>
<div class="wrap">
<h2>Assign Ad Slots</h2><br><br>

<form method="post" action="options.php">
    <?php 
    settings_fields( 'ad-settings-group' );
    do_settings_sections( 'ad-plugin' ); 
    
    submit_button(); ?>

</form>
</div>

<?php 

} 

function add_admin_scripts() {
   wp_enqueue_script(  'underwriting-metabox', get_bloginfo('template_directory').'/static/js/underwriting-metabox.js', array( 'jquery' ) );  
}
add_action('admin_enqueue_scripts','add_admin_scripts');



