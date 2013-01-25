 $(document).ready(function(){
  
  var errorcodes = {ok:1, error:-1, fileexists:-2, fatal:-3, cannotsave:-4};
  var texts = {emailSentOK:"E-Mail successfully sent.", emailSentNOK:"Problem sending E-Mail"};
  
	$.fn.getUrlParam = function(name) {
		var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
		return results[1] || 0;
	};
		
	
	$.fn.preview = function() {
		var content = $("#markdownText").val();
		$.post("./service.php", { action: "gethtml", content:content }, 
		function(data) {
			data = eval('(' + data + ')');
			if (data.code < errorcodes.ok){
				alert(data.result);
			} else {
				var html = $(this).blockQuotesWithIds(data.result);
				$("#preview").contents().find('body').html(html);
				$(this).setPreviewLayoutCSS();
			}
		});
	};


	$.fn.blockQuotesWithIds = function(data) {
		var element = $('<div id="">'+data+'</div>');
		var count = element.find("blockquote").length;
		var bq1 = element.find("blockquote").first();
		var bq_last = element.find("blockquote").last();
		
		bq1.find("p:nth-child(1)").attr("id", "from");
		bq1.find("p:nth-child(2)").attr("id", "to");
		bq1.find("p:nth-child(3)").attr("id", "date");
		
		bq_last.find("p:nth-child(1)").attr("id", "greet");
		bq_last.find("p:nth-child(2)").attr("id", "sign");
		
		return element;
		
	};

	$.fn.getLayout = function(data) {
		return $("#layout").val();		
	};
	
	$.fn.setPreviewLayoutCSS = function(data) {
		$('#preview').contents().find('head').html('<link href="./templates/'+$(this).getLayout()+'" rel="stylesheet" type="text/css" />');
	};

	$('#layout').change(function() {
		$(this).setPreviewLayoutCSS();
	});
	
	$('#editFont').change(function() {
		var editFont = $("#editFont").val();
		$("#letter textarea").css("font-family", editFont);
	});
	

	$.fn.getPDF = function() {
		var content = $("#markdownText").val();
		var layout = $(this).getLayout();
		
		// Fix iPad issue after viewing the PDF the Preview iFrame is empty. So, just return to the Edit-Page.
		if (isiPad || isiPhone) {
			$("#defaultNavTab").click();
		}
		
		$.post("./service.php", { action: "gethtml", content:content }, 
		function(data) {
			data = eval('(' + data + ')');
			if (data.code < errorcodes.ok){
				alert(data.result);
			} else {
				var html = $(this).blockQuotesWithIds(data.result);
				$("#form").attr("action", "service.php");
				$("#form").html('<input type="hidden" name="action" value=""/><input type="hidden" name="content" value=""/><input type="hidden" name="template" value="" />');
				$("#form input[name=action]").val("getpdf");
				$("#form input[name=template]").val(layout);
				$("#form input[name=content]").val(html.html());
				$("#form").submit();
			}
		});
	};
	

	$.fn.getPDFMail = function() {
		var content = $("#markdownText").val();
		var layout = $(this).getLayout();
		var email = $("#email").val();
		
		$.post("./service.php", { action: "gethtml", content:content }, 
		function(data) {
			data = eval('(' + data + ')');
			if (data.code < errorcodes.ok){
				alert(data.result);
			} else {
				var html = $(this).blockQuotesWithIds(data.result);
				$.post("./service.php", { action: "getpdfmail", content:html.html(), template:layout, email:email}, 
				function(data) {
					data = eval('(' + data + ')');
					if (data.code < errorcodes.ok){
						$("#emailSuccess").html(texts.texts.emailSentNOK);
					} else {
						$("#emailSuccess").css("color", "green");
						$("#emailSuccess").css("text-align", "center");
						$("#emailSuccess").html(texts.emailSentOK);
					}
				});
			}
		});
	};

	$.fn.closeDialog = function(data) {
		$('.ui-dialog').dialog('close');
		$("#emailSuccess").html("");
	};



	// Document ready
	$('#preview').append("body");
	$("#defaultNavTab").click();	  
	var isiPad = /ipad/i.test(navigator.userAgent.toLowerCase());
	var isiPhone = /iphone/i.test(navigator.userAgent.toLowerCase());

	
});
			 