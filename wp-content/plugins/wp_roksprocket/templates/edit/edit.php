<?php
/**
 * @package        Joomla.Administrator
 * @subpackage     com_modules
 * @copyright      Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later; see LICENSE.txt
 */


?>
<!-- Begin RokGallery MetaBox -->
<script type="text/javascript">
    window.addEvent('domready', function () {
        new Tips(".rok-tips", {title:"data-tips"});
    });
    jQuery(document).ready(function ($) {
        $("#rok-tabs").tabs();
    });
</script>
<div class="page-header">
    <div id="icon-roksprocket" class="icon32"></div>
    <h2>RokSprocket Widget Settings</h2>
    <?php echo RokCommon_Composite::get($that->context)->load('toolbar.php', array('that' => $that->toolbar, 'data_id' => $that->data->id, 'site_url' => $that->siteURL));?>
</div>
<div style="clear:both;"></div>

<div class="page-body">
<div id="system-message-container" class="sprocket-messages">
	<div id="message"></div>
</div>

<form autocomplete="off" action="<?php echo $this->base_url; ?>"
	  method="post" name="adminForm" id="module-form" class="form-validate">
	<div id="details">
		<?php echo $that->form->getInput('id'); ?>
		<ul>
			<li>
				<?php echo $that->form->getLabel('title'); ?>
				<?php echo $that->form->getInput('title'); ?>
			</li>
			<?php if ($that->data->id > 0) : ?>
			<li class="details">
				<label class="sprocket-tip" data-original-title="<?php echo rc__('ROKSPROCKET_SHORTCODE_DESC'); ?>"><?php echo rc__('ROKSPROCKET_SHORTCODE_LABEL'); ?></label>
				<div class="shortcode">
					[roksprocket id="<?php echo $that->data->id; ?>"]
				</div>
				<a class="copy-to-clipboard sprocket-tip" data-original-title="Copy to Clipboard" data-placement="above" href="#"><i class="icon tool clipboard"></i></a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
	<div id="tabs-container">
		<div class="roksprocket-version">RokSprocket <span>v<?php echo str_replace("\1.8.3", "DEV", ROKSPROCKET_VERSION); ?></span></div>
		<ul class="tabs">
<!--			<li class="tab active" data-tab="options">-->
<!--				<i class="icon options"></i>-->
<!--				<span>Options</span>-->
<!--			</li>-->
<!--			--><?php
//			$fieldSets = $that->form->getFieldsets('params');
//			foreach ($fieldSets as $name => $fieldSet) :
//				if (in_array($name,array('roksprocket','advanced'))) continue;
//				$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_MODULES_' . $name . '_FIELDSET_LABEL';
//				// TODO: Order the fieldset tips better
////                if (isset($fieldSet->description) && trim($fieldSet->description)) :
////                    echo '<p class="tip">' . $that->escape(rc__($fieldSet->description)) . '</p>';
////                endif;
//				?>
<!--				<li class="tab" data-tab="--><?php //echo $name;?><!--">-->
<!--					<i class="icon other"></i>-->
<!--					<span>--><?php //echo $label;?><!--</span>-->
<!--				</li>-->
<!--			 --><?php //endforeach; ?>
<!--			<li class="separator"></li>-->
			<li class="badge">
				<ul>
					<?php foreach($that->container['roksprocket.providers.registered'] as $provider_id => $provider_info):?>
					<li style="display: <?php echo ($that->provider == $provider_id)?"block":"none";?>;"><i class="icon provider provider_<?php echo $provider_id;?> <?php echo $provider_id;?>"></i> <span><?php echo $provider_info->displayname;?> Provider</span></li>
					<?php endforeach; ?>
					<?php foreach($that->container['roksprocket.layouts'] as $layout_id => $layout_info):?>
					<li style="display: <?php echo ($that->layout == $layout_id)?"block":"none";?>;"><i class="icon layout layout_<?php echo $layout_id;?> <?php echo $layout_id;?>"></i> <span><?php echo $layout_info->displayname?> Layout</span></li>
					<?php endforeach; ?>
				</ul>
			</li>
		</ul>
		<div class="panels">
			<div data-panel="options" class="panel options active">
				<?php  echo RokCommon_Composite::get($that->context)->load('edit_roksprocket.php', array('that'=>$that)); ?>
			</div>
		</div>
	</div>
    <input name="task" type="hidden" value="" id="task">
</form>

</div>
<div style="clear:both;"></div>
