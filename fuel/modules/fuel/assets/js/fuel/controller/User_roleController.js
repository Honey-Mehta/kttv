// jqx.load('plugin', 'date');

fuel.controller.User_roleController = jqx.createController(fuel.controller.BaseFuelController, {
	
	init: function(initObj){
		this._super(initObj);
	},

	add_edit : function(){
		this._super();		
		// add ability to create new navigation inline
		$('#related_items li a').click(function(e){
			var url = $(this).attr('href');
			var html = '<iframe src="' + url +'" id="add_edit_inline_iframe" class="inline_iframe" frameborder="0" scrolling="no" style="border: none; height: 0px; width: 0px;"></iframe>';
			var label = '';
			var group = '';
			var iframeContext = null;
			var _this = this;
			var onCloseCallback = function(){
				if (label.length){
					var newLabel = label + ' (' + group + ')';
					$(_this).html(newLabel);
				}
			}

			$modal = fuel.modalWindow(html, 'inline_edit_modal', true, null, onCloseCallback);
		
			// bind listener here because iframe gets removed on close so we can't grab the id value on close
			$modal.find('iframe#add_edit_inline_iframe').bind('load', function(){
				var iframeContext = this.contentDocument;
				label = $('#label', iframeContext).val();
				group = $('#group_id option:selected', iframeContext).text();
			})
			return false;
		})
	

	}
		
});