var buttonPlus  = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

var incrementPlus = buttonPlus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  $n.val(Number($n.val())+1 );
});

var incrementMinus = buttonMinus.click(function() {
  var $n = $(this)
  .parent(".qty-container")
  .find(".input-qty");
  var amount = Number($n.val());
  if (amount > 0) {
    $n.val(amount-1);
  }
});


let buttonTawar =  document.querySelector(".tawar");

if (typeof(buttonTawar) != 'undefined' && buttonTawar != null)
{
    buttonTawar.addEventListener("click",function(){
        divCountTawar = document.querySelector(".count-tawar");
        divCountTawar.classList.toggle("hide")
    });
}


