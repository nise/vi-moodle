<?php
/**
 * Page module version information
 *
 * @package    mod
 * @subpackage page
 * @copyright  2017 Niels Seidel, social-machinables.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot.'/mod/videodatabase/locallib.php');
require_once($CFG->libdir.'/completionlib.php');

$id      = optional_param('id', 0, PARAM_INT); // Course Module ID
$p       = optional_param('p', 0, PARAM_INT);  // videodatabase instance ID
$inpopup = optional_param('inpopup', 0, PARAM_BOOL);

if ($p) {
    if (!$videodatabase = $DB->get_record('videodatabase', array('id'=>$p))) {
        print_error('invalidaccessparameter');
    }
    $cm = get_coursemodule_from_instance('videodatabase', $videodatabase->id, $videodatabase->course, false, MUST_EXIST);
} else {
    if (!$cm = get_coursemodule_from_id('videodatabase', $id)) {
        print_error('invalidcoursemodule');
    }
    $videodatabase = $DB->get_record('videodatabase', array('id'=>$cm->instance), '*', MUST_EXIST);
}

$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);
require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/videodatabase:vdb_video-manager', $context);

// Update 'viewed' state if required by completion system
require_once($CFG->libdir . '/completionlib.php');
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

/* begin header*/
$PAGE->set_url('/mod/videodatabase/vdb_video-manager.php', array('id' => $cm->id));
$PAGE->navbar->add('Video Manager');// , new moodle_url('vdb_video-manager.php'.'?id='.$cm->id));

//$options = empty($videodatabase->displayoptions) ? array() : unserialize($videodatabase->displayoptions);

if ($inpopup and $videodatabase->display == RESOURCELIB_DISPLAY_POPUP) {
    $PAGE->set_pagelayout('popup');
    $PAGE->set_title($course->shortname.': '.$videodatabase->name);
    $PAGE->set_heading($course->fullname);
} else {
    $PAGE->set_title($course->shortname.': '.$videodatabase->name);
    $PAGE->set_heading($course->shortname.': '.$videodatabase->name);//$course->fullname);
    $PAGE->set_activity_record($videodatabase);
}
// custome CSS
$PAGE->requires->css( '/mod/videodatabase/styles.css', true );
$PAGE->requires->css( '/mod/videodatabase/css/bootstrap.min.css');
$PAGE->requires->css( '/mod/videodatabase/css/vi-two.css', true );
echo $OUTPUT->header();
/* end header */




//echo $OUTPUT->heading(format_string($videodatabase->name), 2);
echo "<div class='container-fluid'>";

// don't Know wether this will be needed
if (!empty($options['printintro'])) {
    if (trim(strip_tags($videodatabase->intro))) {
        echo $OUTPUT->box_start('mod_introbox', 'videodatabaseintro');
        echo format_module_intro('videodatabase', $videodatabase, $cm->id);
        echo $OUTPUT->box_end();
    }
}
/*
$content = file_rewrite_pluginfile_urls($videodatabase->content, 'pluginfile.php', $context->id, 'mod_videodatabase', 'content', $videodatabase->revision);
$formatoptions = new stdClass;
$formatoptions->noclean = true;
$formatoptions->overflowdiv = true;
$formatoptions->context = $context;
$content = format_text($content, $videodatabase->contentformat, $formatoptions);
*/







// form
//echo '<div id="app-form">{{ form_content }}</div>';

// video player
echo '<script type="text/x-template" id="app-videoplayer">
<div>
	<!-- Storage -->
	<div style="display:none; visibility:hidden;" id="vi2"></div>
	<!-- End Storage -->
	<!-- Player -->
	<div id="wrapper" style="overflow:hidden;">
		<div id="pagex" style="overflow:hidden;">
			<!-- Main -->
			<div class="container-fluid">
				<h2>{{ video.title }}</h2>
				<div class="row">
					<div id="videowrapper" class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						<div id="seq" class="col-md-12"></div>
						<div id="overlay" class=""></div>
						<div id="split" class="col-md-9"></div>
						<div id="screen" class="col-md-9"></div>
					</div>
					<div id="accordion-resizer" class="col-lg-3 col-md-3 col-sm-3 hidden-xs">
						<div id="accordion" class="video-metadata">
							<label>Beschreibung:</label> {{ video.description }}
							<br />
							<label>Kompetenzen:</label> {{ video.compentencies}}
							<br />
							<label>Sportart:</label> {{ video.sports }}
							<br />
							<label>Bewegungsfelder:</label> {{ video.movements }}
							<br />
							<label>Aktivitäten:</label> {{ video.activities }}
							<br />
							<label>Perspektiven:</label> {{ video.perspectives }}
							<br />
							<label>Ort:</label> {{ video.location }}
							<br />
							<label>Klasse:</label> {{ video.klasse }}
							<hr />
							<label>Produzent:</label> {{ video.contributor }}
							<br />
							<label>Herausgeber:</label> {{ video.publisher }}
							<br />
						</div>
					</div>
				</div>
				<div id="video-controls" class="video-controls col-lg-9 col-md-9 col-sm-12 col-xs-12">
					<div class="timelines">
						<!--<div class="vi2-video-seeklink vi2-btn"></div>-->
						<div class="vi2-timeline-top"></div>
						<div class="vi2-timeline-main vi2-btn"></div>
						<div class="vi2-timeline-bottom"></div>
						<div class="vi2-video-progress vi2-btn"></div>
					</div>
					<div class="control-bar">
						<div class="vi2-video-play-pause vi2-btn" title="Play/Pause">
							<span class="fa fa-play"></span>
							<span class="fa fa-pause"></span>
						</div>
						<div class="vi2-volume-box">
							<div class="vi2-volume-slider"></div>
							<span class="vi2-volume-button vi2-btn" title="Mute/Unmute"></span>
						</div>
						<div class="vi2-video-timer right"></div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div hidden class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-form">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body"></div>
						<div class="modal-validation"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default btn-remove-data"><span class="fa fa-trash"> </span> löschen</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">abbrechen</button>
							<button type="button" class="btn btn-primary btn-sava-data">speichern</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
</script>';


echo '<h1>Videos</h1>';

// filter
echo '<div id="debug" hidden class="alert alert-success" role="alert"></div>';



// video manager
echo '
<div id="app-videomanager">
	<router-view></router-view>
	<div class="zap-slideout" :class="{ isOpen: isOpen }">
		<div class="zap-slideout-opener" @click="toggle">{{openerText}}</div>
		<div class="zap-slideout-menu">Menu</div>
	</div>
	<div id="videomanager" class="video-manager row">
			<div class="filterbox">
				<div id="filter1"></div>
				<a role="button" data-toggle="collapse" href="#filter2" aria-expanded="false" aria-controls="filter2">Erweiterte Filter</a>
				<div class="collapse" id="filter2"></div>
			</div>
			<div 
				v-for="video in videos" 
				v-bind:class="\'col-xs-12 col-sm-5 col-md-2 video-item \'+ videoItemClass(video.id)"
				>
                <router-link class="title" :to="{ path: \'/videos/\' + video.id + \'/view\'}">
					<img 
						v-on:mouseover="mouseOverCheck = video.id" 
						v-on:mouseout="mouseOverCheck = \'\'" 
	 					class="still-images" 
						 v-bind:src="mouseOverCheck === video.id ? \'images/stills/still-\'+video.filename.replace(\'.mp4\',\'_comp.gif\') : \'images/stills/still-\'+video.filename.replace(\'.mp4\',\'_comp.jpg\') " />    
                </router-link>	
                <div class="meta">
                    <router-link class="title" :to="{ path: \'/videos/\' + video.id + \'/view\'}">{{video.title}}</router-link>
                    <div>{{video.klasse}}</div>
                    <div>{{ video.sport }}</div>	
                </div>
            </div>
    </div>
</div>';


echo "</div>"; // end fluid container




$PAGE->requires->js_amd_inline(" 
    require(['jquery', 'mod_videodatabase/filter'], function($, f) {
       //
    });
");





/*********************************/
echo $OUTPUT->footer();
/*********************************/
