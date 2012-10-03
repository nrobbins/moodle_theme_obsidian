<?php

$hasheading = ($PAGE->heading);
$hasnavbar = (empty($PAGE->layout_options['nonavbar']) && $PAGE->has_navbar());
$hasfooter = (empty($PAGE->layout_options['nofooter']));
//has blocks regions
$hassidepre = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-pre', $OUTPUT));
$hassidepost = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-post', $OUTPUT));
$hassidetop = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-top', $OUTPUT));
$hassidebottom = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('side-bottom', $OUTPUT));
$hasbottomleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-left', $OUTPUT));
$hasbottomcenter = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-center', $OUTPUT));
$hasbottomright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('bottom-right', $OUTPUT));
$hastopleft = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-left', $OUTPUT));
$hastopcenter = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-center', $OUTPUT));
$hastopright = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('top-right', $OUTPUT));
//show block regions
$showsidepre = ($hassidepre && !$PAGE->blocks->region_completely_docked('side-pre', $OUTPUT));
$showsidepost = ($hassidepost && !$PAGE->blocks->region_completely_docked('side-post', $OUTPUT));
$showsidetop = ($hassidetop && !$PAGE->blocks->region_completely_docked('side-top', $OUTPUT));
$showsidebottom = ($hassidebottom && !$PAGE->blocks->region_completely_docked('side-bottom', $OUTPUT));
$showbottomleft = ($hasbottomleft && !$PAGE->blocks->region_completely_docked('bottom-left', $OUTPUT));
$showbottomcenter = ($hasbottomcenter && !$PAGE->blocks->region_completely_docked('bottom-center', $OUTPUT));
$showbottomright = ($hasbottomright && !$PAGE->blocks->region_completely_docked('bottom-right', $OUTPUT));
$showtopleft = ($hastopleft && !$PAGE->blocks->region_completely_docked('top-left', $OUTPUT));
$showtopcenter = ($hastopcenter && !$PAGE->blocks->region_completely_docked('top-center', $OUTPUT));
$showtopright = ($hastopright && !$PAGE->blocks->region_completely_docked('top-right', $OUTPUT));


$haslogininfo = (empty($PAGE->layout_options['nologininfo']));

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($showsidepre && !$showsidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($showsidepost && !$showsidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$showsidepost && !$showsidepre) {
    $bodyclasses[] = 'content-only';
}
if ($hascustommenu) {
    $bodyclasses[] = 'has_custom_menu';
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>
<div id="page">
<?php if ($hasheading) { ?>
    <div id="page-header">
        <?php if ($hasheading) { ?>
        <h1 class="headermain"><?php echo $PAGE->heading ?></h1>
        <div class="headermenu"><?php
            if ($haslogininfo) {
                echo $OUTPUT->login_info();
            }
            if (!empty($PAGE->layout_options['langmenu'])) {
                echo $OUTPUT->lang_menu();
            }
            echo $PAGE->headingmenu
        ?></div><?php } ?>
        <?php if ($hascustommenu) { ?>
        <div id="custommenu"><?php echo $custommenu; ?></div>
        <?php } ?>
    </div>
<?php } ?>
<?php if ($hasnavbar) { ?>
		<div class="navbar clearfix">
				<div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>
				<div class="navbutton"> <?php echo $PAGE->button; ?></div>
		</div>
<?php } ?>
<!-- END OF HEADER -->

    <div id="page-content">
        <div id="region-main-box">
            <div id="region-post-box">

                <div id="region-main-wrap"
								<?php 
										if((!$hassidepost)&&(!$hassidepre)&&(!$hassidetop)){
												echo 'class="aside-empty"';
										} else if (!$hassidepost||!$hassidepre){
												echo 'class="aside-single"';
										}
								?>>
                    <div id="region-main">
												<?php if($hastopleft || $hastopcenter || $hastopright){ ?>
												<div id="top-blocks" class="<?php
														if($hastopleft&&$hastopcenter&&$hastopright){
															echo 'triple-wide';
														}else if((!$hastopleft&&!$hastopcenter)||(!$hastopleft&&!$hastopright)||(!$hastopcenter&&!$hastopright)){
															echo 'single-wide';
														}else{
															echo 'double-wide';
														}
												?>">
														<div class="left-block">
																<?php echo $OUTPUT->blocks_for_region('top-left') ?>
														</div>
														<div class="center-block">
																<?php echo $OUTPUT->blocks_for_region('top-center') ?>
														</div>
														<div class="right-block">
																<?php echo $OUTPUT->blocks_for_region('top-right') ?>
														</div>
												</div>
												<div class="clearfix"></div>
												<?php } ?>
                        <div class="region-content">
                            <?php echo $OUTPUT->main_content() ?>
                        </div>
												<?php if($hasbottomleft || $hasbottomcenter || $hasbottomright){ ?>
												<div id="bottom-blocks" class="<?php
														if($hasbottomleft&&$hasbottomcenter&&$hasbottomright){
															echo 'triple-wide';
														}else if((!$hasbottomleft&&!$hasbottomcenter)||(!$hasbottomleft&&!$hasbottomright)||(!$hasbottomcenter&&!$hasbottomright)){
															echo 'single-wide';
														}else{
															echo 'double-wide';
														}
												?>">
														<div class="left-block">
																<?php echo $OUTPUT->blocks_for_region('bottom-left') ?>
														</div>
														<div class="center-block">
																<?php echo $OUTPUT->blocks_for_region('bottom-center') ?>
														</div>
														<div class="right-block">
																<?php echo $OUTPUT->blocks_for_region('bottom-right') ?>
														</div>
												</div>
												<div class="clearfix"></div>
												<?php } ?>
                    </div>
                </div>
								<div id="aside" <?php 
										if((!$hassidepost)&&(!$hassidepre)&&(!$hassidetop)&&(!$hassidebottom)){
												echo 'class="aside-empty"';
										} else if (!$hassidepost||!$hassidepre){
												echo 'class="aside-single"';
										}
										?>>
										<?php if ($hassidetop) { ?>
										<div id="side-top">
											<?php echo $OUTPUT->blocks_for_region('side-top') ?>
										</div>
										<?php } ?>
										<?php if ($hassidepre) { ?>
										<div id="region-pre" class="block-region <?php if(!$hassidepost){ echo 'region-solitary';} ?>">
												<div class="region-content">
														<?php echo $OUTPUT->blocks_for_region('side-pre') ?>
												</div>
										</div>
										<?php } ?>

										<?php if ($hassidepost) { ?>
										<div id="region-post" class="block-region <?php if(!$hassidepre){ echo 'region-solitary';} ?>">
												<div class="region-content">
														<?php echo $OUTPUT->blocks_for_region('side-post') ?>
												</div>
										</div>
										<?php } ?>
										<?php if ($hassidebottom) { ?>
										<div id="side-bottom">
											<?php echo $OUTPUT->blocks_for_region('side-bottom') ?>
										</div>
										<?php } ?>
								</div>
            </div>
        </div>
    </div>

<!-- START OF FOOTER -->
    <?php if ($hasfooter) { ?>
    <div id="page-footer" class="clearfix">
        <p class="helplink"><?php echo page_doc_link(get_string('moodledocslink')) ?></p>
        <?php
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </div>
    <?php } ?>
</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>