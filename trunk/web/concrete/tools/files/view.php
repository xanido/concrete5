<?
defined('C5_EXECUTE') or die(_("Access Denied."));
$c = Page::getByPath("/dashboard/mediabrowser");
$cp = new Permissions($c);
$u = new User();
$form = Loader::helper('form');
if (!$cp->canRead()) {
	die(_("Access Denied."));
}

$f = File::getByID($_REQUEST['fID']);
if (isset($_REQUEST['fvID'])) {
	$fv = $f->getVersion($_REQUEST['fvID']);
} else {
	$fv = $f->getApprovedVersion();
}

?>

<div id="ccm-file-manager-download-bar">
<form method="post" action="<?=REL_DIR_FILES_TOOLS_REQUIRED?>/files/download/" id="ccm-file-manager-download-form">
<?=$form->hidden('fID', $f->getFileID()); ?>
<?=$form->hidden('fvID', $f->getFileVersionID()); ?>
<?=$form->submit('submit', t('Download'))?>
</form>
</div>

<div style="text-align: center">

<?

$to = $fv->getTypeObject();
Loader::element('files/view/' . $to->getView(), array('fv' => $fv));

?>
</div>

<script type="text/javascript">
$(function() {
	$("#ccm-file-manager-download-form").attr('target', ccm_alProcessorTarget);
});
</script>