<?php
defined("DUPXABSPATH") or die("");
/** IDE HELPERS */
/* @var $GLOBALS['DUPX_AC'] DUPX_ArchiveConfig */

DUPX_View_S2::cpanlePanel();
DUPX_View_S2::cpanelSetup();
?>
<script>
   
    var cpnlHostInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_HOST)); ?>; 
    var cpnlUserInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_USER)); ?>; 
    var cpnlPassInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_PASS)); ?>; 
    
    var cpnlDbActionInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_ACTION)); ?>;  
    var cpnlDbHostInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_HOST)); ?>; 
    
    var cpnlDbNameWrapperId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormWrapperId(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_TXT)); ?>; 
    var cpnlDbNameInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_TXT)); ?>; 
    var cpnlDbNameSelWrapperId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormWrapperId(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_SEL)); ?>; 
    var cpnlDbNameSelInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_NAME_SEL)); ?>; 
    var cpnlPrefixInputId = <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_PREFIX)); ?>;
    var cpnlDbUserWrapperId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormWrapperId(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_TXT)); ?>; 
    var cpnlDbUserInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_TXT)); ?>; 
    var cpnlDbUserSelWrapperId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormWrapperId(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_SEL)); ?>; 
    var cpnlDbUserSelInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_SEL)); ?>; 
    var cpnlDbUserCheckInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_USER_CHK)); ?>; 
    
    var cpnlDbPassInputId =  <?php echo DupProSnapJsonU::wp_json_encode($paramsManager->getFormItemId(DUPX_Paramas_Manager::PARAM_CPNL_DB_PASS)); ?>; 


    var cpnlPrefix = '';
/**
 * Returns the windows active url */
DUPX.getcPanelURL = function(button)
{
	var loc      = window.location;
	var newVal	 = loc.protocol + '//' + loc.hostname + ':2038';
	$(button).parent().find('input').val(newVal);
};


/**
 *  Performs cpnl connection and updates UI */
DUPX.cpnlConnect = function ()
{

	var $formInput = $('#s2-input-form');
	$formInput.parsley().validate();
	if (!$formInput.parsley().isValid()) {
		return;
	}

	$('#s2-cpnl-connect-btn').attr('readonly', 'true').val('Connecting... Please Wait!');
	$('a#s2-cpnl-status-msg').hide();

	var apiAccountActive = function(data)
	{
		var html	= "";
		var error	= "Unknown Error";
		var cpnlPrefix	= "";
		var validHost  = false;
		var validUser  = false;

		if (typeof data == 'undefined')	{
			error = "Unknown error, unable to retrive data request.";
			CPNL_CONNECTED = false;
		}
		else if (data.hasOwnProperty('status') && data.status == 0)	{
			error = data.hasOwnProperty('statusText') ? data.statusText : "Unknown error, unable to retrive status text.";
			CPNL_CONNECTED = false;
		}
		else if (data.hasOwnProperty('result')) {
			validHost		= data.result.valid_host;
			validUser		= data.result.valid_user;
			CPNL_DBINFO		= data.result.hasOwnProperty('dbinfo')  ? data.result.dbinfo  : null;
			CPNL_DBUSERS	= data.result.hasOwnProperty('dbusers') ? data.result.dbusers : null;
			CPNL_CONNECTED	= validHost && validUser;
		}

		html += validHost	? "<b>Host:</b>  <div class='dupx-pass'>Success</div> &nbsp; "
							: "<b>Host:</b>  <div class='dupx-fail'>Unable to Connect</div> &nbsp;";
		html += validUser	? "<b>Account:</b> <div class='dupx-pass'>Found</div><br/>"
							: "<b>Account:</b> <div class='dupx-fail'>Not Found</div><br/>";

		if (CPNL_CONNECTED)
		{
			var setupDBName = '<?php echo strlen($GLOBALS['DUPX_AC']->cpnl_dbname) > 0 ? $GLOBALS['DUPX_AC']->cpnl_dbname : 'null'; ?>';
			var setupDBUser = '<?php echo strlen($GLOBALS['DUPX_AC']->cpnl_dbuser) > 0 ? $GLOBALS['DUPX_AC']->cpnl_dbuser : 'null'; ?>';
			var $dbNameSelect = $("#" + cpnlDbNameSelInputId);
			var $dbUserSelect = $("#" + cpnlDbUserSelInputId);

			//Set Prefix data
			if(data.result.is_prefix_on.status)
			{
				cpnlPrefix = $('#' + cpnlUserInputId).val() + "_";
                $('#' + cpnlPrefixInputId).val(cpnlPrefix);
				var dbnameTxt = $("#" + cpnlDbNameInputId).val();
				var dbuserTxt = $("#" + cpnlDbUserInputId).val();

				$("#cpnl-prefix-dbname, #cpnl-prefix-dbuser").show().html(cpnlPrefix);
				if (dbnameTxt.indexOf(cpnlPrefix) != -1) {
					$("#" + cpnlDbNameInputId).val(dbnameTxt.replace(cpnlPrefix, ''));
				}
				if (dbuserTxt.indexOf(cpnlPrefix) != -1) {
					$("#" + cpnlDbUserInputId).val(dbuserTxt.replace(cpnlPrefix, ''));
				}
				CPNL_PREFIX = true;
			} else {
				$("#cpnl-prefix-dbname, #cpnl-prefix-dbuser").hide().html("");
				$('#cpnl_ignore_prefix').attr('checked', 'true');
				$('#cpnl_ignore_prefix').attr('onclick', 'return false;');
				$('#cpnl_ignore_prefix').attr('onkeydown', 'return false;');
				var $label = $('label[for="cpnl_ignore_prefix"]');
				$label.css('color', 'gray');
				$label.html($label.text() + ' <i>(this option has been set to readonly by host)</i>');
				CPNL_PREFIX = false;
			}

			//Enable database inputs and show header green go icon
			DUPX.cpnlToggleLogin('on');
			$('a#s2-cpnl-status-msg').html('<div class="status-badge-pass">success</div>');
			$('div#s2-cpnl-status-details-msg').html(html);
			$("div[data-target='#s2-cpnl-area']").trigger('click');

			//Load DB Names
			$dbNameSelect.find('option').remove().end();
			$dbNameSelect.append($("<option selected></option>").val("").text("-- Select Database --"));
			$.each(CPNL_DBINFO, function (key, value)
			{
				(setupDBName == value.db)
					? $dbNameSelect.append($("<option selected></option>").val(value.db).text(value.db))
					: $dbNameSelect.append($("<option></option>").val(value.db).text(value.db));
			});

			//Load DB Users
			$dbUserSelect.find('option').remove().end();
			$dbUserSelect.append($("<option selected></option>").val("").text("-- Select User --"));
			$.each(CPNL_DBUSERS, function (key, value)
			{
				(setupDBUser == value.user)
					? $dbUserSelect.append($("<option selected></option>").val(value.user).text(value.user))
					: $dbUserSelect.append($("<option></option>").val(value.user).text(value.user));
			});

			 //Warn on host name mismatch
			 var address = window.location.hostname.replace('www.', '');
			 ($("#" + cpnlHostInputId).val().indexOf(address) == -1)
				? $('#cpnl-host-warn').show()
				: $('#cpnl-host-warn').hide();
		}
		else
		{
			//Auto message display
			html += "<b>Details:</b> Unable to connect. Error status is: '" + error + "'. <br/>";
			$('a#s2-cpnl-status-msg').html('<div class="status-badge-fail">failed</div>');
			$('div#s2-cpnl-status-details-msg').html(html);
			$('div#s2-cpnl-status-details').show(500);
			//Inputs
			DUPX.cpnlToggleLogin('off');
		}
		$('a#s2-cpnl-status-msg').show(200);
		$('#s2-cpnl-connect-btn').removeAttr('readonly').val('Connect');
		DUPX.cpnlSetResults();
	}

	DUPX.requestAPI({
		operation: '/cpnl/create_token/',
		timeout: 10000,
		params: {
			host: $("#" + cpnlHostInputId).val(),
			user: $('#' + cpnlUserInputId).val(),
			pass: $('#' + cpnlPassInputId).val()
		},
		callback: function (data) {
			CPNL_TOKEN = data.result;
			DUPX.requestAPI({
				operation: '/cpnl/get_setup_data/',
				timeout: 30000,
				params: {token: data.result},
				callback: apiAccountActive
			});
		}
	});
};

/**
 *  Enables/Disables database setup and cPanel login inputs  */
DUPX.cpnlToggleLogin = function (state)
{
	//Change btn enabled
	if (state == 'on') {
		$('#' + cpnlHostInputId +', #' + cpnlUserInputId +', #' + cpnlPassInputId).addClass('readonly').attr('readonly', 'true');
		$('#s2-cpnl-connect-btn').addClass('disabled').attr('disabled', 'true');
		$('#s2-cpnl-change-btn').removeAttr('disabled').removeClass('disabled').show();
		//Enable cPanel Database
		$('#s2-cpnl-db-opts td').css('color', 'black');
		$('#s2-cpnl-db-opts input, #s2-cpnl-db-opts select').removeAttr('disabled');
		$('#cpnl-host-get-lnk').hide();
	}
	//Change btn disabled
	else {
		$('#' + cpnlHostInputId +', #' + cpnlUserInputId +', #' + cpnlPassInputId).removeClass('readonly').removeAttr('readonly');
		$('#s2-cpnl-connect-btn').removeAttr('disabled', 'true').removeClass('disabled');
		$('#s2-cpnl-change-btn').addClass('disabled').attr('disabled', 'true');
		//Disable cPanel Database
		$('#s2-cpnl-db-opts td').css('color', 'silver');
		$('#s2-cpnl-db-opts input, #s2-cpnl-db-opts select').attr('disabled', 'true');
		$('#cpnl-host-get-lnk').show();
	}
}

/**
 *  Updates action status  */
DUPX.cpnlDBActionChange = function ()
{
	var action = $('#' + cpnlDbActionInputId).val();
	$('#s2-cpnl-db-opts .s2-warning-manualdb').hide();
	$('#s2-cpnl-db-opts .s2-warning-emptydb').hide();
	$('#s2-cpnl-db-opts .s2-warning-renamedb').hide();

	switch (action) {
		case 'create' :	 
            $('#' + cpnlDbNameInputId).val('');
            $('#' + cpnlDbNameWrapperId).show(300);
            $('#' + cpnlDbNameSelWrapperId).hide();	
            break;
		case 'empty' :
            $('#' + cpnlDbNameSelInputId).trigger('change');
			$('#' + cpnlDbNameWrapperId).hide();
            $('#' + cpnlDbNameSelWrapperId).show(300);
			$('#s2-cpnl-db-opts .s2-warning-emptydb').show(300);
		break;
		case 'rename' :
            $('#' + cpnlDbNameSelInputId).trigger('change');
			$('#' + cpnlDbNameWrapperId).hide();
            $('#' + cpnlDbNameSelWrapperId).show(300);
			$('#s2-cpnl-db-opts .s2-warning-renamedb').show(300);
		break;
		case 'manual' :
            $('#' + cpnlDbNameSelInputId).trigger('change');
			$('#' + cpnlDbNameWrapperId).hide();
            $('#' + cpnlDbNameSelWrapperId).show(300);
			$('#s2-cpnl-db-opts .s2-warning-manualdb').show(300);
		break;
	}
};

/**
 *  Set the cpnl dbname and dbuser result hidden fields  */
DUPX.cpnlSetResults = function()
{
   var action = $('#' + cpnlDbActionInputId).val();
   var dbname = $("#" + cpnlDbNameInputId).val();
   var dbuser = $("#" + cpnlDbUserInputId).val();
/*
	if (CPNL_PREFIX) {
		dbname = cpnlPrefix + $("#" + cpnlDbNameInputId).val();
		dbuser = cpnlPrefix + $("#" + cpnlDbUserInputId).val();
	}
    
    if (action != 'create') {
        $("#" + cpnlDbNameInputId).val($("#" + cpnlDbNameSelInputId).val());
    }

    if (!$('#' + cpnlDbUserCheckInputId).is(':checked')) {
        $("#" + cpnlDbUserInputId).val($("#" + cpnlDbUserSelInputId).val());
    }*/
}

DUPX.cpnlPrefixIgnore = function()
{
	if ($('#cpnl_ignore_prefix').prop('checked')) {
		CPNL_PREFIX = false;
		$("#cpnl-prefix-dbname, #cpnl-prefix-dbuser").hide();
	}
	else {
		CPNL_PREFIX = true;
		$("#cpnl-prefix-dbname, #cpnl-prefix-dbuser").show();
	}
	DUPX.cpnlSetResults();
}

/**
 *  Toggle the DB user name type  */
DUPX.cpnlDBUserToggle = function ()
{
	$('#' + cpnlDbUserWrapperId + ', #' + cpnlDbUserSelWrapperId).hide();
	$('#' + cpnlDbUserSelInputId + ', #' + cpnlDbUserInputId).removeAttr('disabled');
	$('#' + cpnlDbUserSelInputId + ', #' + cpnlDbUserInputId).removeAttr('required');
    
    $('#' + cpnlDbUserInputId).attr('required', 'true');
    $('#' + cpnlDbPassInputId).attr({ 
        'required' : 'true'
    });

	//Use existing
	if ($('#' + cpnlDbUserCheckInputId).prop('checked')) {
        $('#' + cpnlDbUserInputId).val('');
		$('#' + cpnlDbUserWrapperId).show();
		$('#' + cpnlDbUserSelWrapperId).hide();
	//Create New
	} else {
        $('#' + cpnlDbUserSelInputId).trigger('changed');
        $('#' + cpnlDbUserWrapperId).hide();
		$('#' + cpnlDbUserSelWrapperId).show();
	}
	DUPX.cpnlSetResults();
}

//DOCUMENT LOAD
$(document).ready(function ()
{
	//Custom Validator
	window.Parsley.addValidator('cpnluser', {
		validateString: function(value) {
		  var prefix = CPNL_PREFIX
				? $('#' + cpnlUserInputId).val() + "_" + value
				: value;
		  return (prefix.length <= 24);
		},
		messages: {
		  en: 'Database user cannot be more that 24 characters including prefix'
		}
	});

	//Attach Events
	$("#" + cpnlDbActionInputId).on("change", DUPX.cpnlDBActionChange);
	$("#" + cpnlDbUserCheckInputId).click(DUPX.cpnlDBUserToggle);
    
	$('#' + cpnlDbNameSelInputId).on("change", DUPX.cpnlSetResults);
	$('#' + cpnlDbUserSelInputId).on("change", DUPX.cpnlSetResults);

	<?php echo ($GLOBALS['DUPX_AC']->cpnl_connect) ? 'DUPX.cpnlConnect();' : ''; ?>
	$("#" + cpnlDbActionInputId).val(<?php echo strlen($GLOBALS['DUPX_AC']->cpnl_dbaction) > 0 ? "'{$GLOBALS['DUPX_AC']->cpnl_dbaction}'" : 'create'; ?>);
	DUPX.cpnlDBActionChange();
	DUPX.cpnlDBUserToggle();
	DUPX.cpnlToggleLogin('off');
	DUPX.cpnlSetResults();

	$("input[name='cpnl-dbmysqlmode']").click(function() {
		($(this).val() == 'CUSTOM')
			? $('#cpnl-dbmysqlmode_3_view').show()
			: $('#cpnl-dbmysqlmode_3_view').hide();
	});

});
</script>
