/**
Discount editable input.
Internally value stored as {city: "Moscow", street: "Lenina", building: "15"}

@class address
@extends abstractinput
@final
@example
<a href="#" id="address" data-type="address" data-pk="1">awesome</a>
**/

// $(function(){
//     $('#address').editable({
//         url: '/post',
//         title: 'Enter city, street and building #',
//         value: {
//             city: "Moscow", 
//             street: "Lenina", 
//             building: "15"
//         }
//     });
// });


(function ($) {
    "use strict";
    
    var Discount = function (options) {
        this.init('discount', options, Discount.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(Discount, $.fn.editabletypes.abstractinput);

    $.extend(Discount.prototype, {
        /**
        Renders input from tpl

        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = $('<div>').text(value.nominal).html().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {city: "Moscow", street: "Lenina", building: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    city: "Moscow", 
                    street: "Lenina", 
                    building: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
           if(!value) {
             return;
           }
           this.$input.filter('[name="x_discount_persen"]').val(value.xpersen);
           this.$input.filter('[name="x_discount_nominal"]').val(value.xnominal);
           
       },       
       
       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() { 
           return {
              persen: this.$input.filter('[name="x_discount_persen"]').val(), 
              nominal: this.$input.filter('[name="x_discount_nominal"]').val(), 
           };
       },        
       
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
            this.$input.filter('[name="x_discount_persen"]').focus();
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
           this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
           });
       }       
    });

    Discount.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="editable-address"><label><span>Persen: </span><input type="number" step="any" name="x_discount_persen" class="input-small" value="0"></label></div>'+
             '<div class="editable-address"><label><span>Nominal: </span><input type="number" step="any" name="x_discount_nominal" class="input-small" value="0"></label></div><br>',
             
        inputclass: 'disc_editable'
    });

    $.fn.editabletypes.address = Discount;

}(window.jQuery));