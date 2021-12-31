$(document).ready(function(){
	var i = 0;
	$('#add').click(function(){
        // $('.center').hide();
		i++;
		$('#dynamic_field').append('\
            <div class = "new-addition na'+i+'">\
                <label class="firstname'+i+' lbladd1" for="firstname'+i+'">First Name - Family Member #'+i+'</label>\
                <input type="text" id="firstname'+i+'" class ="inputadd1" placeholder="Enter first name here" name="firstname[]" required>\
                \
                <label class="lastname'+i+' lbladd2" for="lastname'+i+'">Last Name - Family Member #'+i+'</label>\
                <input type="text" id="lastname'+i+'" class ="inputadd2" placeholder="Enter last name here" name="lastname[]">\
                \
                <label class="food'+i+' lbladd3" for="food'+i+'">Please select their meal option?</label>\
                <select type="text" id="food'+i+'" class="inputadd3" name="food[]" required>\
                    <option selected hidden value="">Select One</option>\
                    <option value = "Steak">Steak</option>\
                    <option value = "Chicken">Chicken</option>\
                    <option value = "Salmon">Salmon</option>\
                    <option value = "Kids Meal">Kids Meal</option>\
                </select>\
                \
                <label class="allergies'+i+' lbladd4" for="allergies'+i+'">Please note any allergies/restrictions</label>\
                <textarea type="text" id="allergies'+i+'" class="inputadd4" placeholder="Type here" name="allergies[]"></textarea>\
                \
            </div>\
                <div class="center '+i+' centeradd">\
                    <button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">(-) Remove</button>\
                </div>');
        
        $(".mainadd").insertAfter("."+i);
        $(".new-addition").addClass("animatersvp");
	});


//Remove
    $(document).on('click', '.btn_remove', function(){  
    	var button_id = $(this).attr("id");
        $('.na'+button_id+'').addClass("animatersvp-remove");
        $('.animatersvp-remove').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e){
        	$('#'+button_id+'').remove();
            $('.'+button_id+'').remove();
            $('.na'+button_id+'').remove();
            $('.na'+button_id+'').remove();
            // $('.center').show();
            i-=1;

            //Change label, class, for less 1
            $('.lbladd1').each(function(y, obj) {
                $(this).html('First Name - Family Member #'+(y+1));
                $(this).attr("class","firstname"+(y+1)+' lbladd1');
                $(this).attr("for","firstname"+(y+1));
            });
            $('.lbladd2').each(function(y, obj) {
                $(this).html('Last Name - Family Member #'+(y+1));
                $(this).attr("class","lastname"+(y+1)+' lbladd2');
                $(this).attr("for","lastname"+(y+1));
            });
            $('.lbladd3').each(function(y, obj) {
                $(this).attr("class","food"+(y+1)+' lbladd3');
                $(this).attr("for","food"+(y+1));
            });
            $('.lbladd4').each(function(y, obj) {
                $(this).attr("class","allergies"+(y+1)+' lbladd4');
                $(this).attr("for","allergies"+(y+1));
            });
        

            //Change ID's of inputs less 1
            $('.inputadd1').each(function(y, obj) {
                $(this).attr("id","firstname"+(y+1));
            });
            $('.inputadd2').each(function(y, obj) {
                $(this).attr("id","lastname"+(y+1));
            });
            $('.inputadd3').each(function(y, obj) {
                $(this).attr("id","food"+(y+1));
            });
            $('.inputadd4').each(function(y, obj) {
                $(this).attr("id","allergies"+(y+1));
            });

            //Change class of center divs less 1
            $('.centeradd').each(function(y, obj) {
                $(this).attr("class","center "+(y+1)+" centeradd");
            });

            //Change id of remove buttons less 1
            $('.btn_remove').each(function(y, obj) {
                $(this).attr("id",(y+1));
            });
            //Change class of new addition div wrapper less 1
            $('.new-addition').each(function(y, obj) {
                $(this).attr("class","new-addition na"+(y+1)+" animatersvp");

            });
        });

    });
});
