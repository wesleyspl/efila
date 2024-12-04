$(function(){
	//alert(123);
	load_userlist();
	setInterval("load_userlist()",2000);
});

function load_userlist(){
	check_messages();
	$.get("membership/ajax.php?action=get_userlist",function(data){
		var html;
		for(var i=0; i < data.length; i++){
			html += '<div id="chat-panel" class="panel panel-default"> \
					    <div class="panel-heading bg-darkblue-2"> \
					      <h4 class="panel-title"> \
					        <a href="#chat-col'+i+'" data-toggle="collapse"> \
					          <i class="icon-briefcase-1"></i> '+data[i].name+' \
					          <span class="label bg-darkblue-1 pull-right">'+data[i].users.length+'</span> \
					        </a> \
					      </h4> \
					    </div> \
					    <div class="panel-collapse collapse in" id="chat-col'+i+'"> \
					      <div class="panel-body"> \
					      <ul id="chat-list" class="list-unstyled">';
			for(var x=0; x < data[i].users.length; x++){
				var unread = data[i].users[x].has_unread > 0?'<span class="label bg-red-1 pull-right">'+data[i].users[x].has_unread+'</span>':'';
				if(data[i].users[x].online == '1'){
					var st = "online";
				}else if(data[i].users[x].online == '2'){
					var st = "away";
				}else{
					var st = "offline";
				}
				html += '<li><a class="'+st+'" href="javascript:;" onclick="open_chat('+data[i].users[x].UID+')"><span class="chat-user-avatar"><img src="'+data[i].users[x].avatar+'"></span> <span class="chat-user-name">'+data[i].users[x].name+'</span>'+unread+'<span class="chat-user-msg">'+(data[i].users[x].message?data[i].users[x].message:'')+'</span></a></li>';
			}
			html += '</ul> \
			      </div> \
			    </div> \
			  </div>'; 
		}
		$("#connect #collapse").html(html);
	},"json");
	//setInterval("check_messages()",5000);
	return true;
}

function open_chat(uid){
	$("#connect .tab-inner .chat_window").removeClass("active");
	$.get("membership/ajax.php?action=load_chat&uid="+uid, function(data){
		var l = $("#connect #u-"+uid).length;
		if(l == 0){
			$("#connect .tab-inner").append("<div id='u-"+uid+"' class='chat_window'><div class='chat_header'></div><div class='chat_logs'><div class='chat_logs_inner'></div></div><div class='chat_panel'><textarea placeholder='Type your message...' id='chat_message'></textarea><a class='btn btn-large btn-success chat_send_btn' onclick='send_message("+uid+")'>SEND</a></div></div>");
		}
		$("#connect .tab-inner").addClass("chat-open");
		setTimeout(function(){
			$("#connect #u-"+uid).addClass("active");
		},100);

		var $cwin = $("#connect #u-"+uid);
		$cwin.find(".chat_header").html("<a class='pull-left btn btn-link' href='#' onclick='close_chat("+uid+")'><i class='fa fa-chevron-left'></i></a><h3>"+data.name+"</h3>");

		var chatlogs = "";
		for(i = 0; i < data.chat_logs.length; i++){
			var lg = data.chat_logs[i];
			if(lg.fromid == uid){
				chatlogs += "<div class='row chat_line'><div class='col-xs-11 chat_buble left' title='"+lg.sent_time+"'><div class='avatar-wrap'><img src='"+data.avatar+"' class='img-circle chat_avatar' title='"+data.name+"'></div><div class='pull-left inner_bubble'>"+lg.message+"</div></div></div>";
			}else{
				chatlogs += "<div class='row chat_line'><div class='col-xs-11 col-xs-offset-1 chat_buble right text-right' title='"+lg.sent_time+"'><div class='inner_bubble pull-right'>"+lg.message+"</div></div></div>";
			}
		}

		$("#connect #u-"+uid+" .chat_logs_inner").html(chatlogs);

		$("#connect .chat_logs_inner").slimscroll({
	      height: 'auto',
	      size: "5px"
	    });

	    $("#connect #u-"+uid+" #chat_message").keyup(function(e) {
		    if (e.keyCode == 13) {
		    	send_message(uid);
		    	return false;
		    }
		});
		movetobottom();

	},"json");
}

function movetobottom(){
	var wtf    = $("#connect .chat_logs_inner");
	var height = wtf[0].scrollHeight;
	wtf.slimScroll({ scrollTo: height});
}

function send_message(uid){
	var msg = $("#connect #u-"+uid+" #chat_message").val();

	if(msg.length > 0){
		$("#connect #u-"+uid+" .chat_logs_inner").append("<div class='row chat_line'><div class='col-xs-11 col-xs-offset-1 chat_buble right text-right' title='just now'><div class='inner_bubble pull-right'>"+msg+"</div></div></div>");
		$("#connect #u-"+uid+" #chat_message").val("");
		$.post("membership/ajax.php?action=send_message", "uid="+uid+"&message="+msg, function(data){

		},"json");
		setTimeout("movetobottom()",100);
	}
}

function check_messages(){
	if($(".chat_window.active").length)
		var cid = $(".chat_window.active").attr("id").split("-")[1];

	$.post("membership/ajax.php?action=check_messages", "clist="+cid, function(data){

		$.each(data, function( index, value ) {
			value = [].concat(value);
			for(i = 0; i < value.length; i++){
				if(index == cid){
					$("#connect #u-"+index+" .chat_logs_inner").append("<div class='row chat_line'><div class='col-xs-11 chat_buble left' title='"+value[i].sent_time+"'><div class='avatar-wrap'><img src='"+value[i].avatar+"' class='img-circle chat_avatar' title='"+value[i].name+"'></div><div class='pull-left inner_bubble'>"+value[i].message+"</div></div></div>");
					setTimeout("movetobottom()",100);
				}else{
					chat_notify(value[i]);
				}
			}
			console.log(value);
		});
	},"json");
}

function chat_notify(user) {
    $.notify({
        text: "<a href='javascript:;' onclick='view_chat("+user.fromid+")' class='chat-notif chat-message'>"+user.message+"</a>",
        image: "<img class='img-circle chat-avatar' src='"+user.avatar+"'>",
        title: "<a href='javascript:;' class='chat-notif' onclick='view_chat("+user.fromid+")'>"+user.name+"</a>"
    }, {
        style: 'metro',
        className: "cool",
        showAnimation: "show",
        showDuration: 0,
        autoHide: false,
        clickToHide: true
    });
}

function view_chat(id){
	$("#wrapper").addClass("open-right-sidebar");
	$('#right-tabs a[href="#connect"]').tab('show');
	open_chat(id);
	return false;
}

function close_chat(uid){
	$("#connect .tab-inner").removeClass("chat-open");
	$("#connect #u-"+uid).removeClass("active");
	load_userlist();
}