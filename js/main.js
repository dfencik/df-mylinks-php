var dummy='';
function clik(urlid,hits,th)
{
	var ret="";
		if(urlid != '')
		{
			$.ajax({url: "inc/inc_set_hit.php?hits="+hits+"&urlid=" + urlid,
				success: function(data){ ret=eval(data)},
				async: false
			});
		}
		if(ret.err.toString()=='1')
		{
			//window.location.href=$(th).next("input[type='hidden']").val();
			w=window.open($(th).next("input[type='hidden']").val());
		}
		return;
}
$(document).ready(function()
{
	$("li.incontainer")
		.bind("mouseenter",function(){
			$(".edit-container").css("display","none");
			$(this).find(".edit-container").css({"display":"inline"});})
		.bind("mouseleave",function(){
			$(this).find(".edit-container").css("display","none");
		});
	$(".edit-container > i")
		.bind("click",function(){ 
			var action = $(this).hasClass("icon-remove") ? 'D' : 'E';
			var mUrlID=$(this).parents("li").find("input[type='hidden'].idholder").val();
			if(action=='E')
			{
				var grpID=$(this).parents("div.span3.groups").find("input[name='grpIdHolder']").val();
				var grpName=$(this).parent("p").prev("p").find("a").html();
				var mUrl=$(this).parent("p").prev("p").find("input[type='hidden'].urlholder").val().replace(/&/g,"~");
				var txt=getContent({'grpid':{'grpId':grpID,'grpName':grpName},'linkid':mUrlID,'mUrl':mUrl});
				showDialog(txt, {'linkid':mUrlID,'grpId':grpID,'mUrl':mUrl});
			}
			if(action=='D' && confirm("Vymazaù z·znam ["+mUrlID+"] ?"))
			{
				var ret="";
				$.ajax({url: "inc/inc_deletelink.php",
					data: "lnkID=" + mUrlID,
					success: function(data){ ret=eval(data)},
					async: false
				});
				
				if(ret.err.toString()=='1')
				{
					location.reload(true);
				}
				else
				{
					alert(ret.err);					
				}
			}
		})
	// wire up the buttons to dismiss the modal when shown
	$("i.icon-plus-sign")
		.unbind("click")
		.bind("click",function(){
		var grpId=$(this).parent('span').find('input[type=hidden]').val()
		var grpName=$(this).parent('span').prev('span').text();			
		var txt=getContent({'grpid':{'grpId':grpId,'grpName':''},'linkid':'','mUrl':''});
		showDialog(txt, {'linkid':'','grpId':grpId,'mUrl':'','mUrlID':''});
	//end bind
	});		
	$("i.icon-bookmark")
		.unbind("click")
		.bind("click",function(){
			$this=$(this);
			var pinned=0;
			if($this.hasClass("icon-white"))
			{
				$this
					.removeClass("icon-white")
					.addClass("icon-black")
					.parent("div.groups").trigger("mouseenter")
					pinned=1;
			}
			else
			{
				$this
					.removeClass("icon-black")
					.addClass("icon-white")
					pinned=0;
			}
		var grpId=$this.parent('span').find('input[type=hidden]').val();
		updatePinned(grpId,pinned);	
		});
		
	$(".groups")
		.unbind("mousenter")
		.unbind("mouseleave")
		.bind("mouseenter",function(){
			var $this=$(this);
			if($this.find("i").hasClass("icon-white"))
			{
				$this.find(".innergroups").show();
			}
		})
		.bind("mouseleave",function(){
			var $this=$(this);
			if($this.find("i").hasClass("icon-white"))
			{
				$this.find(".innergroups").hide();
			}
		})
 
 })
 
 function updatePinned(id,pinned)
 {
 	$.ajax({ cache: false, type: "POST",url: "inc/inc_pin_unpin.php", data: "grpid=" + id + "&pin=" + pinned, 
 			success: function(msg){	location.reload(true); 
 			},
 			error:function (xhr, ajaxOptions, thrownError){
                     alert('Nastala chyba:'+ xhr.status + ' -> ' +thrownError);
                 }    
 			});
 	return;
 }

function showDialog(txt, props)
{
	bootbox.dialog( txt, [
	{
	    "label" : "Zavrieù",
	    "class" : "btn btn-primary",
	    "callback": function() { bootbox.hideAll(); return true;}
	},
	{
	    "label" : "Uloû",
	    "class" : "btn btn-success",
	    "callback": function() { 
		var lnkID=props.linkid;
		var grpID=$("#cmbGroup").val();
		var mUrl=$("#murl").val().replace(/&/g,"~");
		$.ajax({
			  contentType: 'application/x-www-form-urlencoded; charset=windows-1250',
			  url: "inc/inc_dialogsave.php",
			  data: "delete=0&lnkID="+ lnkID +"&grpID=" + grpID + "&grpName=" + $("#cmbGroup option:selected").text() + "&lnkName=" + $("#nazov").val() + "&lnkUrl=" + mUrl,
			  success: function(data){
			     msg=eval(data);
				 if(msg.err.toString() != "1")
	     			{
						alert(msg.err);
	     			}
	     			else
	     			{
	     				location.reload(true);
	     			}
			     },
			  async: false
			});
	 }
	}
	], {
	    "backdrop" : "static",
	    "keyboard" : true,
	    "show"     : true
	});
}

function getContent(args)
{
	var grp=args.grpid;
	var grpID=grp.grpId;
	var grpName=grp.grpName;
	var lnkID=args.linkid;
	var mUrl=args.mUrl;
	if(typeof grpID == "undefined") grpID="";
	if(typeof lnkID == "undefined") lnkID="";
	var ret="";
	$.ajax({
	  url: "inc/inc_dialogcontent.php",
	  data: "mUrl="+ mUrl +"&grpid=" + grpID + "&linkid=" + lnkID + "&grpname=" + grpName,
	  success: function(data){ ret=data},
	  async: false
	});
	return ret;
}
 