var delivery = document.querySelectorAll('.delivery_card');
for(var i =0 ; i < delivery.length ; i++){
    delivery[i].addEventListener("click",function(event){
        var element_Clicked = document.querySelectorAll('.delivery_card.card_active');
        

        element_Clicked = element_Clicked[0];
        element_Clicked.setAttribute('class',"delivery_card");

        element_Children = element_Clicked.children[0];
        element_Children.setAttribute('class',"delivery_title");

        element_Clicked.children[3].remove();

        var target = this;
        //console.log(target);
        var clicked = target.getAttribute("class");
        target.setAttribute("class",clicked + " card_active");

        
        var child = target.children[0];
        clicked = child.getAttribute("class");
        child.setAttribute('class',clicked + " header_active")

        target.innerHTML += '<div class="icon_clicked"><span class="material-symbols-outlined">check_small</span></div>';
        load_delivery();
    })
}

var delivery = document.querySelectorAll('.payment_card');
for(var i =0 ; i < delivery.length ; i++){
    delivery[i].addEventListener("click",function(event){
        var element_Clicked = document.querySelectorAll('.payment_card.card_active');
        

        element_Clicked = element_Clicked[0];
        element_Clicked.setAttribute('class',"payment_card");

        element_Children = element_Clicked.children[0];
        element_Children.setAttribute('class',"payment_icon");

        element_Clicked.children[2].remove();

        var target = this;
        //console.log(target);
        var clicked = target.getAttribute("class");
        target.setAttribute("class",clicked + " card_active");

        
        var child = target.children[0];
        clicked = child.getAttribute("class");
        child.setAttribute('class',clicked + " header_active")

        target.innerHTML += '<div class="icon_clicked"><span class="material-symbols-outlined">check_small</span></div>';
        
        // set hidden input PaymentID
        var input = document.getElementById("PaymentID");
        input.value = target.getAttribute("data-id");
    })
}

var voucher = document.getElementsByClassName("submit_button");
voucher[0].addEventListener("click",function(event){

    var input = document.getElementById("voucher_input");
    var voucherID = input.value;

    var inform = document.getElementById("voucher_discount");
    var discount = document.getElementById("discount");

    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function (){
        if(this.readyState == 4 && this.status == 200){
            var s = String(this.responseText);
            console.log(s);

            if(s == 0){
                inform.innerText = "*Voucher không hợp lệ hoặc hết hạn!";
            }
            else{
                var voucher = s.split(",");
                var label = document.getElementById("voucher_name_container");
                label.innerHTML =   '<label class="voucher_label">'+voucher[0]+'</label>' +
                                    '<span class="material-symbols-outlined" onclick="delete_Voucher(this);">close</span>';
                
                var input = document.getElementById("VoucherID");
                var input2 = document.getElementById("OrderDiscount");
                // set hidden input VoucherID
                input.value = voucherID;

                if(voucher[2] == "%"){
                    inform.innerText = "-" + voucher[1] + " %";
                    var eleTotal = document.getElementsByClassName("payment_detail_pricetotal");
                    var value =eleTotal[0].getAttribute("data-total");
                    value = parseInt(value) *  parseInt(voucher[1]) / 100 ;
                    discount.innerText = "- " + new Intl.NumberFormat('en-US').format(value) + " đ";
                    document.getElementsByClassName("payment_detail_pricetotal")[2].setAttribute("data-total",value);
                    // set hidden input OrderDiscount
                    input2.value = value;
                    load_total();
                }
                else{
                    inform.innerText = "-" + new Intl.NumberFormat('en-US').format(voucher[1]) + " đ";
                    discount.innerText = "- " + new Intl.NumberFormat('en-US').format(voucher[1]) + " đ";
                    document.getElementsByClassName("payment_detail_pricetotal")[2].setAttribute("data-total",voucher[1]);
                    // set hidden input OrderDiscount
                    input2.value = voucher[1];
                    load_total();
                }
            }
        }
    }
    xml.open("GET","modules/checkVoucher.php?VoucherID="+voucherID.trim(),true);
    xml.send();
})

load_delivery();
function load_delivery(){
    // lấy lựa chọn của user
    var clicked = document.querySelectorAll('.delivery_card.card_active');
    var fee = clicked[0].getAttribute("data-deliveryfee");
    // set lại phí vận chuyển
    var tag = document.getElementById("deliveryfee");
    tag.innerText =  new Intl.NumberFormat('en-US').format(fee) + " đ";
    // set thuộc tính
    tag = tag.parentElement;
    tag.setAttribute("data-total",fee);
    
    // set hidden input ShippingFee
    var input = document.getElementById("ShippingFee");
    input.value = fee;

    load_total();
}

function delete_Voucher(element){
    // xóa voucher
    element = element.parentElement;
    element.innerHTML = "";

    // set lại số tiền giảm giá
    var discount = document.getElementById("discount");
    discount.innerText = "- 0 đ";

    // xóa voucher
    var inform = document.getElementById("voucher_discount");
    inform.innerText = "";

    document.getElementsByClassName("payment_detail_pricetotal")[2].setAttribute("data-total",0);

    var input = document.getElementById("VoucherID");
    var input2 = document.getElementById("OrderDiscount");
    input.value = "NULL";
    input2.value = 0;

    load_total();
}

load_total();
function load_total(){
    var priceTotal = document.getElementsByClassName("payment_detail_pricetotal");

    var sum = 0;
    for (var i =0; i < priceTotal.length -1 ; i++){
        sum += parseInt(priceTotal[i].getAttribute('data-total'));
    }
    sum -= parseInt(priceTotal[2].getAttribute('data-total'));

    var total = document.getElementsByClassName("payment_detail_total")[0];
    total = total.children[1];

    total.innerText = new Intl.NumberFormat('en-US').format(sum) + " đ";
    
    // set hidden input total
    var input = document.getElementById("Total");
    input.value = sum;
}