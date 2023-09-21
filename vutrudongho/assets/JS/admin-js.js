//API address
const host = "https://provinces.open-api.vn/api/";

var callAPI = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data, "modal-user-container-content-province");
        });
}

var callApiDistrict = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.districts, "modal-user-container-content-district");
        });
}
var callApiWard = (api) => {
    return axios.get(api)
        .then((response) => {
            renderData(response.data.wards, "modal-user-container-content-ward");
        });
}

var renderData = (array, select) => {
    let row = '<option disable value="">-- Chọn --</option>';
    array.forEach(element => {
        row += `<option value='${element.code}/${element.name}'>${element.name}</option>`;
    });
    document.querySelector("#" + select).innerHTML = row;
}

var eventForAddressCombobox = () => {
    $("#modal-user-container-content-province").on('input', function () {
        if($("#modal-user-container-content-province option:selected").val() != '') {
            callApiDistrict(host + "p/" + $("#modal-user-container-content-province").val().split('/')[0] + "?depth=2");
        } else {
            document.querySelector("#modal-user-container-content-district").innerHTML = '<option disable value="">-- Chọn --</option>';
            document.querySelector("#modal-user-container-content-ward").innerHTML = '<option disable value="">-- Chọn --</option>';
        }
    });
    
    $("#modal-user-container-content-district").on('input', function () {
        if($("#modal-user-container-content-district option:selected").val() != '') {
            callApiWard(host + "d/" + $("#modal-user-container-content-district").val().split('/')[0] + "?depth=2");
        } else {
            document.querySelector("#modal-user-container-content-ward").innerHTML = '<option disable value="">-- Chọn --</option>';
        }
    });
}

//Common
var eventCloseModal = (modalClass, modalContainerClass, btnCloseClass) => {
    var btnClose = document.querySelector(`.${btnCloseClass}`);
    var modal = document.querySelector(`.${modalClass}`);
    var modalContainer = document.querySelector(`.${modalContainerClass}`);

    modal.addEventListener('click', function() {
        modal.classList.remove('open');
    });

    modalContainer.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    btnClose.addEventListener('click', function() {
        modal.classList.remove('open');
    });
}

var checkMail = (email) => {
    return email.match(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
}

//SideBar
var eventForSideBar = (num) => {
    var sideBarItems = document.querySelectorAll(".sidebar-nav__item > a");
    for(var i = 0; i < sideBarItems.length - 1; i++) {
        var sideBarItem = sideBarItems[i];
        if(i == num) {
            sideBarItem.classList.add('sidebar-nav__item--click');
            sideBarItem.classList.remove('sidebar-nav-item__link--hover');
        } else {
            sideBarItem.classList.add('sidebar-nav-item__link--hover');
            sideBarItem.classList.remove('sidebar-nav__item--click');
        }
    }
}

//Header
var setValueHeader = (titleText) => {
    let title = document.querySelector('.container-header__title');
    title.innerText = titleText;
}

//ProductForm
var displayEditModal = (productId) => {
    //Display
    var modal_heading = document.querySelector('.modal-product-container__heading');
    var modal = document.querySelector('.modal');
    var btnAdd = document.querySelector('.modal-product-container__btn.insert');
    var btnEdit = document.querySelector('.modal-product-container__btn.edit');
    modal_heading.innerText = "Sửa Đồng Hồ";
    modal.classList.add('open');
    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';

    //Reset err
    resetErr();

    //Set value by current row's value
    let brand = document.getElementById('modal-product-container-content__brand');
    let id = document.getElementById('modal-product-container-content__product-id');
    let name = document.getElementById('modal-product-container-content__product-name');
    let img = document.getElementById('modal-product-container-content__product-img');
    let img_src = document.getElementById('modal-product-container-content__product-img-src');
    let model = document.getElementById('modal-product-container-content__model');
    let color = document.getElementById('modal-product-container-content__color');
    let gender = document.getElementById('modal-product-container-content__gender');
    let import_price = document.getElementById('modal-product-container-content__import-price');
    let price_to_sell = document.getElementById('modal-product-container-content__price-to-sell');
    let discount = document.getElementById('modal-product-container-content__discount');
    let desc = document.getElementById('modal-product-container-content__desc');
    let rbtnTrue = document.getElementById('product-status-true');
    let rbtnFalse = document.getElementById('product-status-false');

    let tds = document.querySelectorAll(`#${productId} > td`);

    brand.value = tds[0].innerText;
    id.value = tds[1].innerText;
    name.value = tds[2].innerText;
    img.type = '';
    img.type = 'file';
    img_src.src = "./assets/img/productImg/" + tds[3].getAttribute('path');
    model.value = tds[4].innerText;
    color.value = tds[5].innerText;
    gender.value = tds[6].innerText;
    import_price.value = tds[7].innerText.replace(/,/g, '');
    price_to_sell.value = tds[8].innerText.replace(/,/g, '');
    discount.value = tds[9].innerText;
    desc.value = tds[10].innerText;
    if(tds[11].innerText == "Kinh doanh") {
        rbtnTrue.checked = true;
    } else {
        rbtnFalse.checked = true;
    }
}

var resetErr = () => {
    let brand_err = document.querySelector('.modal-product-container-content__err-brand');
    let name_err = document.querySelector('.modal-product-container-content__err-name');
    let img_err = document.querySelector('.modal-product-container-content__err-img');
    let model_err = document.querySelector('.modal-product-container-content__err-model');
    let orther_input_model_err = document.querySelector('.modal-product-container-content__err-other-model');
    let color_err = document.querySelector('.modal-product-container-content__err-color');
    let orther_input_color_err = document.querySelector('.modal-product-container-content__err-other-color');
    let gender_err = document.querySelector('.modal-product-container-content__err-gender');
    let import_price_err = document.querySelector('.modal-product-container-content__err-import-price');
    let price_to_sell_err = document.querySelector('.modal-product-container-content__err-price-to-sell');
    let discount_err= document.querySelector('.modal-product-container-content__err-discount');
    let desc_err = document.querySelector('.modal-product-container-content__err-desc');

    brand_err.style.display = "none";
    name_err.style.display = "none";
    img_err.style.display = "none";
    model_err.style.display = "none";
    orther_input_model_err.style.display = "none";
    color_err.style.display = "none";
    orther_input_color_err.style.display = "none";
    gender_err.style.display = "none";
    import_price_err.style.display = "none";
    price_to_sell_err.style.display = "none";
    discount_err.style.display = "none";
    desc_err.style.display = "none";
}

var resetForm = (newProductId) => {
    //Reset form
    let brand = document.getElementById('modal-product-container-content__brand');
    let id = document.getElementById('modal-product-container-content__product-id');
    let name = document.getElementById('modal-product-container-content__product-name');
    let img = document.getElementById('modal-product-container-content__product-img');
    let img_src = document.getElementById('modal-product-container-content__product-img-src');
    let model = document.getElementById('modal-product-container-content__model');
    let color = document.getElementById('modal-product-container-content__color');
    let gender = document.getElementById('modal-product-container-content__gender');
    let import_price = document.getElementById('modal-product-container-content__import-price');
    let price_to_sell = document.getElementById('modal-product-container-content__price-to-sell');
    let discount = document.getElementById('modal-product-container-content__discount');
    let desc = document.getElementById('modal-product-container-content__desc');
    let rbtnTrue = document.getElementById('product-status-true');
    let ortherInputModel = document.getElementById('orther-product-model-input');
    let ortherInputColor = document.getElementById('orther-product-color-input');

    brand.value = "Thương hiệu";
    id.value = newProductId;
    name.value = "";
    img.type = '';
    img.type = 'file';
    img_src.src = './assets/img/admin/place-holder-product/image-placeholder.jpg';
    model.value = "Kiểu máy";
    ortherInputModel.style.display = 'none';
    color.value = "Màu sắc";
    ortherInputColor.style.display = 'none';
    gender.value = "Giới tính";
    import_price.value = '';
    price_to_sell.value = '';
    discount.value = '';
    desc.value = '';
    rbtnTrue.checked = true;

    //Reset err
    resetErr();
}

var displayInsertModal = (newProductId) => {
    //Display
    var modal_heading = document.querySelector('.modal-product-container__heading');
    var modal = document.querySelector('.modal');
    var btnAdd = document.querySelector('.modal-product-container__btn.insert');
    var btnEdit = document.querySelector('.modal-product-container__btn.edit');
    modal_heading.innerText = "Thêm Đồng Hồ Mới";
    modal.classList.add('open');
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    //Reset form
    resetForm(newProductId);
}

var displayOtherInput = (selectId, otherInputId) => {
    let mySelect = document.getElementById(`${selectId}`);
    let ortherInput = document.getElementById(`${otherInputId}`);

    mySelect.addEventListener('change', function() {
        if(mySelect.value == "Khác") {
            ortherInput.style.display = 'flex';
        } else {
            ortherInput.style.display = 'none';
        }
    });
}

var checkValidateProductForm = (action) => {
    let valid = true;
    /*
        1. Các select option không được để trống hoặc mặc định
        2. Các input tên, giá nhập, giá bán không được để trống
        3. Các input giá nhập, giá bán, giảm giá phải lớn hơn hoặc = 0
        4. Img được chọn phải khác url mặc định
    */
    /*
        1. Brand không được để trống
        2. Tên sản phẩm không được để trống
        3. Phải chọn một ảnh cho sản phẩm
        4. Kiểu máy không được trống, nếu tùy chọn là khác thì input nhập tùy chọn không được trống
        5. Màu sắc không được trống, nếu tùy chọn là khác thì input nhập tùy chọn không được trống
        6. Giới tính không được trống
        7. Giá nhập không được trống và phải lớn hơn hoặc bằng 0
        8. Giá bán không được trống và phải lớn hơn hoặc bằng 0
        9. Giảm giá phải lớn hơn hoặc bằng 0 nếu có nhập
    */
    let brand = document.getElementById('modal-product-container-content__brand');
    let brand_err = document.querySelector('.modal-product-container-content__err-brand');
    let name = document.getElementById('modal-product-container-content__product-name');
    let name_err = document.querySelector('.modal-product-container-content__err-name');
    let img = document.getElementById('modal-product-container-content__product-img');
    let img_src = document.getElementById('modal-product-container-content__product-img-src');
    let img_err = document.querySelector('.modal-product-container-content__err-img');
    let model = document.getElementById('modal-product-container-content__model');
    let model_err = document.querySelector('.modal-product-container-content__err-model');
    let orther_input_model = document.getElementById('orther-product-model-value');
    let orther_input_model_err = document.querySelector('.modal-product-container-content__err-other-model');
    let color = document.getElementById('modal-product-container-content__color');
    let color_err = document.querySelector('.modal-product-container-content__err-color');
    let orther_input_color = document.getElementById('orther-product-color-value');
    let orther_input_color_err = document.querySelector('.modal-product-container-content__err-other-color');
    let gender = document.getElementById('modal-product-container-content__gender');
    let gender_err = document.querySelector('.modal-product-container-content__err-gender');
    let import_price = document.getElementById('modal-product-container-content__import-price');
    let import_price_err = document.querySelector('.modal-product-container-content__err-import-price');
    let price_to_sell = document.getElementById('modal-product-container-content__price-to-sell');
    let price_to_sell_err = document.querySelector('.modal-product-container-content__err-price-to-sell');
    let discount = document.getElementById('modal-product-container-content__discount');
    let discount_err= document.querySelector('.modal-product-container-content__err-discount');
    let desc = document.getElementById('modal-product-container-content__desc');
    let desc_err = document.querySelector('.modal-product-container-content__err-desc');

    resetErr();

    if(brand.value == "Thương hiệu") {
        brand_err.innerText = "*Trường này không được để trống";
        brand_err.style.display = "block";
        valid = false;
    }

    if(name.value.trim() == "") {
        name_err.innerText = "*Trường này không được để trống";
        name_err.style.display = "block";
        valid = false;
    } else if(name.value.trim().length > 300) {
        name_err.innerText = "*Tên đồng hồ không vượt quá 300 kí tự";
        name_err.style.display = "block";
        valid = false;
    }

    if(img.value.trim() == '' && img_src.getAttribute('src') == "./assets/img/admin/place-holder-product/image-placeholder.jpg") {
        img_err.innerText = "*Hãy chọn một ảnh đại diện cho sản phẩm";
        img_err.style.display = "block";
        valid = false;
    }

    if(model.value == "Kiểu máy") {
        model_err.innerText = "*Trường này không được để trống";
        model_err.style.display = "block";
        valid = false;
    } else if (model.value == "Khác" && orther_input_model.value == "") {
        model_err.style.display = "none";
        orther_input_model_err.innerText = "*Trường này không được để trống";
        orther_input_model_err.style.display = "block";
        valid = false;
    }

    if(color.value == "Màu sắc") {
        color_err.innerText = "*Trường này không được để trống";
        color_err.style.display = "block";
        valid = false;
    } else if (color.value == "Khác" && orther_input_color.value == "") {
        color_err.style.display = "none";
        orther_input_color_err.innerText = "*Trường này không được để trống";
        orther_input_color_err.style.display = "block";
        valid = false;
    }

    if(gender.value == "Giới tính") {
        gender_err.innerText = "*Trường này không được để trống";
        gender_err.style.display = "block";
        valid = false;
    }

    if(import_price.value.trim() == "") {
        import_price_err.innerText = "*Trường này không được để trống";
        import_price_err.style.display = "block";
        valid = false;
    } else if(parseInt(import_price.value.trim()) < 0) {
        import_price_err.innerText = "*Giá nhập phải lớn hơn hoặc bằng 0";
        import_price_err.style.display = "block";
        valid = false;
    }

    if(price_to_sell.value.trim() == "") {
        price_to_sell_err.innerText = "*Trường này không được để trống";
        price_to_sell_err.style.display = "block";
        valid = false;
    } else if(parseInt(price_to_sell.value.trim()) < 0) {
        price_to_sell_err.innerText = "*Giá bán phải lớn hơn hoặc bằng 0";
        price_to_sell_err.style.display = "block";
        valid = false;
    }

    if(discount.value.trim() != "" && parseInt(discount.value.trim()) < 0) {
        discount_err.innerText = "*Giảm giá phải lớn hơn hoặc bằng 0";
        discount_err.style.display = "block";
        valid = false;
    }

    if(desc.value.trim() == "") {
        desc_err.innerText = "*Trường này không được để trống";
        desc_err.style.display = "block";
        valid = false;
    }

    if(valid) {
        let result = confirm(`Bạn có chắc chắn muốn ${action} đồng hồ này trong cơ sở dữ liệu?`);
        valid = result;
    }
    return valid;
}

var displayPopupDel = (productId) => {
    var conf = confirm(`Bạn có chắc chắn muốn xóa sản phẩm ${productId} ra khỏi cơ sở dữ liệu?`);
    if(conf) {
        window.location.href = `?action=del&product-id=${productId}`;
    }
}

//Brand
var displayInsertBrandModal = (newBrandId) => {
    var modal_heading = document.querySelector('.modal-brand-container-content__heading');
    var modal = document.querySelector('.modal-brand');
    var btnAdd = document.querySelector('.modal-brand-container-content__btn.insert');
    var btnEdit = document.querySelector('.modal-brand-container-content__btn.edit');
    modal_heading.innerText = "Thêm Thương Hiệu Mới";
    modal.classList.add('open');
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    resetBrandForm(newBrandId);
}

var displayEditBrandModal = (brandId) => {
    var modal_heading = document.querySelector('.modal-brand-container-content__heading');
    var modal = document.querySelector('.modal-brand');
    var btnAdd = document.querySelector('.modal-brand-container-content__btn.insert');
    var btnEdit = document.querySelector('.modal-brand-container-content__btn.edit');
    modal_heading.innerText = "Sửa Thương Hiệu";
    modal.classList.add('open');
    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';
    
    resetErrBrandForm();

    let brand_id = document.getElementById('modal-brand-container-content-id');
    let brand_name = document.getElementById('modal-brand-container-content-name');
    let brand_desc = document.getElementById('modal-brand-container-content-desc');
    let brand_status_true = document.getElementById('modal-brand-container-content-status-true');
    let brand_status_false = document.getElementById('modal-brand-container-content-status-false');

    let tds = document.querySelectorAll(`#${brandId} > td`);

    brand_id.value = tds[0].innerText;
    brand_name.value = tds[1].innerText;
    brand_desc.value = tds[2].innerText;
    if(tds[3].innerText == "Hoạt động") {
        brand_status_true.checked = true;
    } else {
        brand_status_false.checked = true;
    }
}

var resetBrandForm = (newProductId) => {
    let brand_id = document.getElementById('modal-brand-container-content-id');
    let brand_name = document.getElementById('modal-brand-container-content-name');
    let brand_desc = document.getElementById('modal-brand-container-content-desc');
    let brand_status_true = document.getElementById('modal-brand-container-content-status-true');

    brand_id.value = newProductId;
    brand_name.value = "";
    brand_desc.value = "";
    brand_status_true.checked = true;

    resetErrBrandForm();
}

var resetErrBrandForm = () => {
    let brand_name_err = document.querySelector('.modal-brand-container-content-name__err');
    let brand_desc_err = document.querySelector('.modal-brand-container-content-desc__err');
    brand_name_err.style.display = "none";
    brand_desc_err.style.display = "none";
}

var checkBrandForm = (action) => {
    valid = true;
    let brand_name = document.getElementById('modal-brand-container-content-name');
    let brand_desc = document.getElementById('modal-brand-container-content-desc');
    let brand_name_err = document.querySelector('.modal-brand-container-content-name__err');
    let brand_desc_err = document.querySelector('.modal-brand-container-content-desc__err');

    resetErrBrandForm();

    if(brand_name.value.trim() == "") {
        brand_name_err.innerText = '*Trường này không được để trống';
        brand_name_err.style.display = "block";
        valid = false;
    } else if(brand_name.value.trim().length > 100) {
        brand_name_err.innerText = '*Tên thương hiệu không vượt quá 100 kí tự';
        brand_name_err.style.display = "block";
        valid = false;
    }

    if(brand_desc.value.trim() == "") {
        brand_desc_err.innerText = '*Trường này không được để trống';
        brand_desc_err.style.display = "block";
        valid = false;
    }

    if(valid) {
        let result
        if(action == 'thêm') {
            result = confirm(`Bạn có chắc chắn muốn ${action} thương hiệu này vào cơ sở dữ liệu?`);
        } else {
            result = confirm(`Bạn có chắc chắn muốn ${action} thương hiệu này vào cơ sở dữ liệu? Lưu ý: Nếu thương hiệu này ngừng hoạt động, thì các sản phẩm thuộc thương hiệu cũng sẽ ngừng kinh doanh, bạn có chắc chắn muốn thay đổi?`);
        }
        valid = result;
    }

    return valid;
}

//Supplier
var displayInsertSupplierModal = (newSupplierId) => {
    var modal_heading = document.querySelector('.modal-supplier-container-content__heading');
    var modal = document.querySelector('.modal-supplier');
    var btnAdd = document.querySelector('.modal-supplier-container-content__btn.insert');
    var btnEdit = document.querySelector('.modal-supplier-container-content__btn.edit');
    modal_heading.innerText = "Thêm Nhà Cung Cấp Mới";
    modal.classList.add('open');
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    resetSupplierForm(newSupplierId);
}

var resetSupplierForm = (newSupplierId) => {
    let supplier_id = document.getElementById('modal-supplier-container-content-id');
    let supplier_name = document.getElementById('modal-supplier-container-content-name');
    let supplier_phone = document.getElementById('modal-supplier-container-content-phone');
    let supplier_email = document.getElementById('modal-supplier-container-content-email');
    let supplier_address = document.getElementById('modal-supplier-container-content-address');
    let supplier_status_true = document.getElementById('modal-supplier-container-content-status-true');

    supplier_id.value = newSupplierId;
    supplier_name.value = "";
    supplier_phone.value = "";
    supplier_email.value = "";
    supplier_address.value = "";
    supplier_status_true.checked = true;

    resetErrSupplierForm();
}

var resetErrSupplierForm = () => {
    let supplier_name_err = document.querySelector('.modal-supplier-container-content-name__err');
    let supplier_phone_err = document.querySelector('.modal-supplier-container-content-phone__err');
    let supplier_email_err = document.querySelector('.modal-supplier-container-content-email__err');
    let supplier_address_err = document.querySelector('.modal-supplier-container-content-address__err');

    supplier_name_err.style.display = "none";
    supplier_phone_err.style.display = "none";
    supplier_email_err.style.display = "none";
    supplier_address_err.style.display = "none";
}

var displayEditSupplierModal = (supplierId) => {
    let modal_heading = document.querySelector('.modal-supplier-container-content__heading');
    let modal = document.querySelector('.modal-supplier');
    let btnAdd = document.querySelector('.modal-supplier-container-content__btn.insert');
    let btnEdit = document.querySelector('.modal-supplier-container-content__btn.edit');
    modal_heading.innerText = "Sửa Nhà Cung Cấp";
    modal.classList.add('open');
    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';

    resetErrSupplierForm();

    let supplier_id = document.getElementById('modal-supplier-container-content-id');
    let supplier_name = document.getElementById('modal-supplier-container-content-name');
    let supplier_phone = document.getElementById('modal-supplier-container-content-phone');
    let supplier_email = document.getElementById('modal-supplier-container-content-email');
    let supplier_address = document.getElementById('modal-supplier-container-content-address');
    let supplier_status_true = document.getElementById('modal-supplier-container-content-status-true');
    let supplier_status_false = document.getElementById('modal-supplier-container-content-status-false');

    let tds = document.querySelectorAll(`#${supplierId} > td`);

    supplier_id.value = tds[0].innerText;
    supplier_name.value = tds[1].innerText;
    supplier_phone.value = tds[2].innerText;
    supplier_email.value = tds[3].innerText;
    supplier_address.value = tds[4].innerText;
    if(tds[5].innerText == "Hoạt động") {
        supplier_status_true.checked = true;
    } else {
        supplier_status_false.checked = true;
    }
}

var checkSupplierForm = (action) => {
    valid = true;
    let supplier_name = document.getElementById('modal-supplier-container-content-name');
    let supplier_phone = document.getElementById('modal-supplier-container-content-phone');
    let supplier_email = document.getElementById('modal-supplier-container-content-email');
    let supplier_address = document.getElementById('modal-supplier-container-content-address');
    let supplier_name_err = document.querySelector('.modal-supplier-container-content-name__err');
    let supplier_phone_err = document.querySelector('.modal-supplier-container-content-phone__err');
    let supplier_email_err = document.querySelector('.modal-supplier-container-content-email__err');
    let supplier_address_err = document.querySelector('.modal-supplier-container-content-address__err');

    resetErrSupplierForm();

    if(supplier_name.value.trim() == "") {
        supplier_name_err.innerText = '*Trường này không được để trống';
        supplier_name_err.style.display = "block";
        valid = false;
    } else if(supplier_name.value.trim().length > 100) {
        supplier_name_err.innerText = '*Tên nhà cung cấp không vượt quá 100 kí tự';
        supplier_name_err.style.display = "block";
        valid = false;
    }

    if(supplier_phone.value.trim() == "") {
        supplier_phone_err.innerText = '*Trường này không được để trống';
        supplier_phone_err.style.display = "block";
        valid = false;
    } else if(supplier_phone.value.trim().length > 10) {
        supplier_phone_err.innerText = '*Số điện thoại không vượt quá 10 kí tự';
        supplier_phone_err.style.display = "block";
        valid = false;
    }

    if(supplier_email.value.trim() == "") {
        supplier_email_err.innerText = "*Trường này không được để trống";
        supplier_email_err.style.display = "block";
        valid = false;
    } else if (checkMail(supplier_email.value.trim()) == null) {
        supplier_email_err.innerText = "*Địa chỉ email không hợp lệ";
        supplier_email_err.style.display = "block";
        valid = false;
    } else if(supplier_email.value.trim().length > 50) {
        supplier_email_err.innerText = '*Email không vượt quá 50 kí tự';
        supplier_email_err.style.display = "block";
        valid = false;
    }

    if(supplier_address.value.trim() == "") {
        supplier_address_err.innerText = "*Trường này không được để trống";
        supplier_address_err.style.display = "block";
        valid = false;
    } else if(supplier_address.value.trim().length > 200) {
        supplier_address_err.innerText = '*Địa chỉ không vượt quá 200 kí tự';
        supplier_address_err.style.display = "block";
        valid = false;
    }

    if(valid) {
        let result = confirm(`Bạn có chắc chắn muốn ${action} nhà cung cấp này vào cơ sở dữ liệu?`);
        valid = result;
    }

    return valid;
}

//Voucher
var displayInsertVoucherModal = (newVoucherId) => {
    var modal_heading = document.querySelector('.modal-voucher-container-content__heading');
    var modal = document.querySelector('.modal-voucher');
    var btnAdd = document.querySelector('.modal-voucher-container-content__btn.insert');
    var btnEdit = document.querySelector('.modal-voucher-container-content__btn.edit');
    modal_heading.innerText = "Thêm Mã Giảm Giá Mới";
    modal.classList.add('open');
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    resetVoucherForm(newVoucherId);
}

var resetVoucherForm = (newVoucherId) => {
    let voucher_id = document.getElementById('modal-voucher-container-content-id');
    let voucher_name = document.getElementById('modal-voucher-container-content-name');
    let voucher_unit = document.getElementById('modal-voucher-container-content-unit');
    let voucher_discount = document.getElementById('modal-voucher-container-content-discount');
    let dateFrom = document.getElementById('modal-voucher-container-content-dateFrom');
    let dateTo = document.getElementById('modal-voucher-container-content-dateTo');
    let voucher_status_true = document.getElementById('modal-voucher-container-content-status-true');

    voucher_id.value = newVoucherId;
    voucher_name.value = "";
    voucher_unit.value = "Đơn vị giảm";
    voucher_discount.value = "";
    dateFrom.value = '';
    dateTo.value = '';
    voucher_status_true.checked = true;

    resetErrVoucherForm();
}

var resetErrVoucherForm = () => {
    let voucher_name_err = document.querySelector('.modal-voucher-container-content-name__err');
    let voucher_unit_err = document.querySelector('.modal-voucher-container-content-unit__err');
    let voucher_discount_err = document.querySelector('.modal-voucher-container-content-discount__err');
    let voucher_dateFrom_err = document.querySelector('.modal-voucher-container-content-dateFrom__err');
    let voucher_dateTo_err = document.querySelector('.modal-voucher-container-content-dateTo__err');

    voucher_name_err.style.display = 'none';
    voucher_unit_err.style.display = 'none';
    voucher_discount_err.style.display = 'none';
    voucher_dateFrom_err.style.display = 'none';
    voucher_dateTo_err.style.display = 'none';
}

var checkVoucherForm = (action) => {
    valid = true;
    let voucher_name = document.getElementById('modal-voucher-container-content-name');
    let voucher_unit = document.getElementById('modal-voucher-container-content-unit');
    let voucher_discount = document.getElementById('modal-voucher-container-content-discount');
    let dateFrom = document.getElementById('modal-voucher-container-content-dateFrom');
    let dateTo = document.getElementById('modal-voucher-container-content-dateTo');

    let voucher_name_err = document.querySelector('.modal-voucher-container-content-name__err');
    let voucher_unit_err = document.querySelector('.modal-voucher-container-content-unit__err');
    let voucher_discount_err = document.querySelector('.modal-voucher-container-content-discount__err');
    let voucher_dateFrom_err = document.querySelector('.modal-voucher-container-content-dateFrom__err');
    let voucher_dateTo_err = document.querySelector('.modal-voucher-container-content-dateTo__err');

    resetErrVoucherForm();

    if(voucher_name.value.trim() == "") {
        voucher_name_err.innerText = '*Trường này không được để trống';
        voucher_name_err.style.display = "block";
        valid = false;
    } else if(voucher_name.value.trim().length > 100) {
        voucher_name_err.innerText = '*Tên mã khuyến mãi không vượt quá 100 kí tự';
        voucher_name_err.style.display = "block";
        valid = false;
    }

    if(voucher_unit.value == "Đơn vị giảm") {
        voucher_unit_err.style.display = "block";
        valid = false;
    }

    if(voucher_discount.value.trim() == "") {
        voucher_discount_err.innerText = "*Trường này không được để trống";
        voucher_discount_err.style.display = "block";
        valid = false;
    } else if(parseInt(voucher_discount.value.trim()) < 0) {
        voucher_discount_err.innerText = "*Giá trị giảm phải lớn hơn hoặc bằng 0";
        voucher_discount_err.style.display = "block";
        valid = false;
    }

    if(dateFrom.value != '' && dateTo.value != '') {
        let dateF = new Date(dateFrom.value);
        let dateT = new Date(dateTo.value);
        if(dateF > dateT) {
            voucher_dateFrom_err.innerText = "*Ngày bắt đầu không được lớn hơn ngày kết thúc"
            voucher_dateFrom_err.style.display = "block";
            voucher_dateTo_err.innerText = "*Ngày kết thúc không được nhỏ hơn ngày bắt đầu"
            voucher_dateTo_err.style.display = "block";
            valid = false;
        }
    } else {
        if(dateFrom.value == '') {
            voucher_dateFrom_err.innerText = "*Hãy chọn ngày bắt đầu";
            voucher_dateFrom_err.style.display = "block";
            valid = false;
        }
    
        if(dateTo.value == '') {
            voucher_dateTo_err.innerText = "*Hãy chọn ngày kết thúc";
            voucher_dateTo_err.style.display = "block";
            valid = false;
        }
    }

    if(valid) {
        let result = confirm(`Bạn có chắc chắn muốn ${action} mã giảm giá này vào cơ sở dữ liệu?`);
        valid = result;
    }

    return valid;
}

var displayEditVoucherModal = (voucherId) => {
    let modal_heading = document.querySelector('.modal-voucher-container-content__heading');
    let modal = document.querySelector('.modal-voucher');
    let btnAdd = document.querySelector('.modal-voucher-container-content__btn.insert');
    let btnEdit = document.querySelector('.modal-voucher-container-content__btn.edit');
    modal_heading.innerText = "Sửa Mã Giảm Giá";
    modal.classList.add('open');
    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';

    resetErrVoucherForm();

    let voucher_id = document.getElementById('modal-voucher-container-content-id');
    let voucher_name = document.getElementById('modal-voucher-container-content-name');
    let voucher_unit = document.getElementById('modal-voucher-container-content-unit');
    let voucher_discount = document.getElementById('modal-voucher-container-content-discount');
    let dateFrom = document.getElementById('modal-voucher-container-content-dateFrom');
    let dateTo = document.getElementById('modal-voucher-container-content-dateTo');
    let voucher_status_true = document.getElementById('modal-voucher-container-content-status-true');
    let voucher_status_false = document.getElementById('modal-voucher-container-content-status-false');

    let tds = document.querySelectorAll(`#${voucherId} > td`);
    voucher_id.value = tds[0].innerText;
    voucher_name.value = tds[1].innerText;
    voucher_unit.value = tds[2].innerText;
    voucher_discount.value = tds[3].innerText;
    dateFrom.value = tds[4].innerText;
    dateTo.value = tds[5].innerText;
    if(tds[6].innerText == "Còn") {
        voucher_status_true.checked = true;
    } else {
        voucher_status_false.checked = true;
    }
}

//User
var displayInsertUserModal = (newUserId) => {
    var modal_heading = document.querySelector('.modal-user-container-content__heading');
    var modal = document.querySelector('.modal-user');
    var btnAdd = document.querySelector('.modal-user-container-content__btn.insert');
    var btnEdit = document.querySelector('.modal-user-container-content__btn.edit');
    modal_heading.innerText = "Thêm Người Dùng Mới";
    modal.classList.add('open');
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    resetUserform(newUserId);
}

var resetUserform = (newUserId) => {
    let user_id = document.getElementById('modal-user-container-content-id');
    let user_name = document.getElementById('modal-user-container-content-name');
    let user_phone = document.getElementById('modal-user-container-content-phone');
    let user_email = document.getElementById('modal-user-container-content-email');
    let user_pass = document.getElementById('modal-user-container-content-password');
    let user_province = document.getElementById('modal-user-container-content-province');
    let user_district = document.getElementById('modal-user-container-content-district');
    let user_ward = document.getElementById('modal-user-container-content-ward');
    let user_houseAndRoadAddress = document.getElementById('modal-user-container-content-houseAndRoadAddress');
    let user_status_true = document.getElementById('modal-user-container-content-status-true');

    user_id.value = newUserId;
    user_name.value = '';
    user_phone.value = '';
    user_email.value = '';
    user_pass.value = '';
    user_province.value = '';
    user_district.value = '';
    user_ward.value = '';
    user_houseAndRoadAddress.value = '';
    user_status_true.checked = true;

    resetErrUserForm();
}

var resetErrUserForm = () => {
    let user_name_err = document.querySelector('.modal-user-container-content-name__err');
    let user_phone_err = document.querySelector('.modal-user-container-content-phone__err');
    let user_email_err = document.querySelector('.modal-user-container-content-email__err');
    let user_pass_err = document.querySelector('.modal-user-container-content-password__err');
    let user_province_err = document.querySelector('.modal-user-container-content-province__err');
    let user_district_err = document.querySelector('.modal-user-container-content-district__err');
    let user_ward_err = document.querySelector('.modal-user-container-content-ward__err');
    let user_houseAndRoadAddress_err = document.querySelector('.modal-user-container-content-houseAndRoadAddress__err');

    user_name_err.style.display = 'none';
    user_phone_err.style.display = 'none';
    user_email_err.style.display = 'none';
    user_pass_err.style.display = 'none';
    user_province_err.style.display = 'none';
    user_district_err.style.display = 'none';
    user_ward_err.style.display = 'none';
    user_houseAndRoadAddress_err.style.display = 'none';
}

var checkUserForm = (action) => {
    valid = true;

    let user_name = document.getElementById('modal-user-container-content-name');
    let user_phone = document.getElementById('modal-user-container-content-phone');
    let user_email = document.getElementById('modal-user-container-content-email');
    let user_pass = document.getElementById('modal-user-container-content-password');
    let user_province = document.getElementById('modal-user-container-content-province');
    let user_district = document.getElementById('modal-user-container-content-district');
    let user_ward = document.getElementById('modal-user-container-content-ward');
    let user_houseAndRoadAddress = document.getElementById('modal-user-container-content-houseAndRoadAddress');

    let user_name_err = document.querySelector('.modal-user-container-content-name__err');
    let user_phone_err = document.querySelector('.modal-user-container-content-phone__err');
    let user_email_err = document.querySelector('.modal-user-container-content-email__err');
    let user_pass_err = document.querySelector('.modal-user-container-content-password__err');
    let user_province_err = document.querySelector('.modal-user-container-content-province__err');
    let user_district_err = document.querySelector('.modal-user-container-content-district__err');
    let user_ward_err = document.querySelector('.modal-user-container-content-ward__err');
    let user_houseAndRoadAddress_err = document.querySelector('.modal-user-container-content-houseAndRoadAddress__err');

    resetErrUserForm();

    if(user_name.value.trim() == '') {
        user_name_err.innerText = '*Trường này không được để trống';
        user_name_err.style.display = 'block';
        valid = false;
    } else if (user_name.value.trim().length > 50) {
        user_name_err.innerText = '*Tên người dùng không vượt quá 50 kí tự';
        user_name_err.style.display = 'block';
        valid = false;
    };

    if(user_phone.value.trim() == '') {
        user_phone_err.innerText = '*Trường này không được để trống';
        user_phone_err.style.display = 'block';
        valid = false;
    } else if (user_phone.value.trim().length > 10) {
        user_phone_err.innerText = '*Số điện thoại không vượt quá 10 kí tự';
        user_phone_err.style.display = 'block';
        valid = false;
    };

    if(user_email.value.trim() == "") {
        user_email_err.innerText = "*Trường này không được để trống";
        user_email_err.style.display = "block";
        valid = false;
    } else if (checkMail(user_email.value.trim()) == null) {
        user_email_err.innerText = "*Địa chỉ email không hợp lệ";
        user_email_err.style.display = "block";
        valid = false;
    } else if(user_email.value.trim().length > 50) {
        user_email_err.innerText = '*Email không vượt quá 50 kí tự';
        user_email_err.style.display = 'block';
        valid = false;
    };

    if(user_pass.value.trim() == '') {
        user_pass_err.innerText = '*Trường này không được để trống';
        user_pass_err.style.display = 'block';
        valid = false;
    } else if (user_pass.value.trim().length > 20) {
        user_pass_err.innerText = '*Mật khẩu không vượt quá 20 kí tự';
        user_pass_err.style.display = 'block';
        valid = false;
    };

    if(user_province.value == '') {
        user_province_err.innerText = '*Trường này không được để trống';
        user_province_err.style.display = 'block';
        valid = false;
    }

    if(user_district.value == '') {
        user_district_err.innerText = '*Trường này không được để trống';
        user_district_err.style.display = 'block';
        valid = false;
    }

    if(user_ward.value == '') {
        user_ward_err.innerText = '*Trường này không được để trống';
        user_ward_err.style.display = 'block';
        valid = false;
    }

    if(user_houseAndRoadAddress.value.trim() == '') {
        user_houseAndRoadAddress_err.innerText = '*Trường này không được để trống';
        user_houseAndRoadAddress_err.style.display = 'block';
        valid = false;
    } else if (user_houseAndRoadAddress.value.trim().length > 50) {
        user_houseAndRoadAddress_err.innerText = '*Trường này không vượt quá 50 kí tự';
        user_houseAndRoadAddress_err.style.display = 'block';
        valid = false;
    };

    if(valid) {
        let result = confirm(`Bạn có chắc chắn muốn ${action} người dùng này vào cơ sở dữ liệu?`);
        valid = result;
    }

    return valid;
}

var displayEditUserModal = (userId) => {
    let modal_heading = document.querySelector('.modal-user-container-content__heading');
    let modal = document.querySelector('.modal-user');
    let btnAdd = document.querySelector('.modal-user-container-content__btn.insert');
    let btnEdit = document.querySelector('.modal-user-container-content__btn.edit');
    modal_heading.innerText = "Sửa Người Dùng";
    modal.classList.add('open');
    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';

    resetErrUserForm();

    let user_id = document.getElementById('modal-user-container-content-id');
    let user_name = document.getElementById('modal-user-container-content-name');
    let user_phone = document.getElementById('modal-user-container-content-phone');
    let user_email = document.getElementById('modal-user-container-content-email');
    let user_pass = document.getElementById('modal-user-container-content-password');
    let user_province = document.getElementById('modal-user-container-content-province');
    let user_district = document.getElementById('modal-user-container-content-district');
    let user_ward = document.getElementById('modal-user-container-content-ward');
    let user_houseAndRoadAddress = document.getElementById('modal-user-container-content-houseAndRoadAddress');
    let user_status_true = document.getElementById('modal-user-container-content-status-true');
    let user_status_false = document.getElementById('modal-user-container-content-status-false');

    let tds = document.querySelectorAll(`#${userId} > td`);

    user_id.value = tds[0].innerText;
    user_name.value = tds[1].innerText;
    user_phone.value = tds[2].innerText;
    user_email.value = tds[3].innerText;
    user_pass.value = tds[4].innerText;

    for(let i = 0; i < user_province.options.length; i++) {
        let option = user_province.options[i];
        if(option.innerText == tds[8].innerText) {
            option.selected = true;
            break;
        }
    };

    callApiDistrict(host + "p/" + $("#modal-user-container-content-province").val().split('/')[0] + "?depth=2").then(() => {
        for(let i = 0; i < user_district.options.length; i++) {
            let option = user_district.options[i];
            if(option.innerText == tds[7].innerText) {
                option.selected = true;
                break;
            }
        };
        callApiWard(host + "d/" + $("#modal-user-container-content-district").val().split('/')[0] + "?depth=2").then(() => {
            for(let i = 0; i < user_ward.options.length; i++) {
                let option = user_ward.options[i];
                if(option.innerText == tds[6].innerText) {
                    option.selected = true;
                    break;
                }
            };
        });
    })

    user_houseAndRoadAddress.value = tds[5].innerText;

    if(tds[9].innerText == "Đang hoạt động") {
        user_status_true.checked = true;
    } else {
        user_status_false.checked = true;
    }
}

//Logout
var confirmLogout = () => {
    let valid = true;
    if(confirm("Bạn có chắc chắn muốn đăng xuất?") == false) {
        valid = false;
    }
    return valid;
}

//Admin account form
var checkValidateAdminAccountForm = () => {
    valid = true;
    let fullname = document.getElementById('FullName');
    let email = document.getElementById('Email');
    let password = document.getElementById('Password');

    let fullname_err = document.querySelector('.err.admin-full-name');
    let email_err = document.querySelector('.err.admin-email');
    let password_err = document.querySelector('.err.admin-password');

    fullname_err.style.display = 'none';
    email_err.style.display = 'none';
    password_err.style.display = 'none';

    if(fullname.value.trim() == '') {
        fullname_err.innerText = "*Tên người quản trị không được để trống"
        fullname_err.style.display = 'block';
        valid = false;
    } else if(fullname.value.trim().length > 100) {
        fullname_err.innerText = "*Tên người quản trị không vượt quá 100 kí tự"
        fullname_err.style.display = 'block';
        valid = false;
    }

    if(email.value.trim() == "") {
        email_err.innerText = "*Email không được để trống";
        email_err.style.display = "block";
        valid = false;
    } else if (checkMail(email.value.trim()) == null) {
        email_err.innerText = "*Địa chỉ email không hợp lệ";
        email_err.style.display = "block";
        valid = false;
    } else if(email.value.trim().length > 50) {
        email_err.innerText = '*Email không vượt quá 50 kí tự';
        email_err.style.display = 'block';
        valid = false;
    };

    if(password.value.trim() == '') {
        password_err.innerText = "*Mật khẩu không được để trống"
        password_err.style.display = 'block';
        valid = false;
    } else if(password.value.trim().length > 20) {
        password_err.innerText = "*Mật khẩu không vượt quá 20 kí tự"
        password_err.style.display = 'block';
        valid = false;
    }

    if(valid) {
        let result = confirm(`Bạn có chắc chắn muốn sửa thông tin quản trị của mình trong cơ sở dữ liệu?`);
        valid = result;
    }

    return valid;
}

//Inventory receiving voucher
var displayInsertInventoryReceivingVoucherModal = (InID) => {
    //Display
    let modal_heading = document.querySelector('.modal-inventory-container-content__heading');
    let modal = document.querySelector('.modal-inventory');
    let btnAdd = document.querySelector('.modal-inventory-container-content__btn.insert');
    let btnEdit = document.querySelector('.modal-inventory-container-content__btn.edit');
    modal_heading.innerText = "Thêm Phiếu Nhập Mới";
    modal.classList.add('open')
    btnAdd.style.display = 'block';
    btnEdit.style.display = 'none';

    //Set up
    let InID_Ui = document.querySelector('.modal-inventory-container-content-info__inid-re');
    InID_Ui.value = InID;
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;
    let date_input = document.querySelector('.modal-inventory-container-content-info__date-re');
    date_input.value = today;
    let supplier_cb = document.querySelector('.modal-inventory-container-content-info__supplier-re');
    supplier_cb.value = "";
    let total_result = document.querySelector('.modal-inventory-container-content__total-re');
    total_result.innerText = ": 0 VND";

    //Reset table
    let tbody = document.querySelector('.modal-inventory-container-content__table tbody');
    tbody.innerHTML = '';
    updateReceivingVoucherTotal();
}

//Inventory receiving voucher
var displayUpdateInventoryReceivingVoucherModal = (InID, SupplierText, Date) => {
    //Display
    let modal_heading = document.querySelector('.modal-inventory-container-content__heading');
    let modal = document.querySelector('.modal-inventory');
    let btnAdd = document.querySelector('.modal-inventory-container-content__btn.insert');
    let btnEdit = document.querySelector('.modal-inventory-container-content__btn.edit');
    modal_heading.innerText = "Sửa Phiếu Nhập";
    modal.classList.add('open');

    btnAdd.style.display = 'none';
    btnEdit.style.display = 'block';

    //Set up
    let InID_Ui = document.querySelector('.modal-inventory-container-content-info__inid-re');
    InID_Ui.value = InID;
    let supplier_cb = document.querySelector('.modal-inventory-container-content-info__supplier-re');
    supplier_cb.value = SupplierText;
    let date_input = document.querySelector('.modal-inventory-container-content-info__date-re');
    date_input.value = Date;

    //Hien thi cac chi tiet phieu nhap
    //Tao doi tuong xmlrequest
    let xhr = new XMLHttpRequest();

    //Thiet lap thong tin yeu cau
    xhr.open('GET', `query-detail-from-InId.php?InID=${InID}`, true);

    // Thiết lập header cho request
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Xử lý response khi server trả về kết quả
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let tbody = document.querySelector('.modal-inventory-container-content__table tbody');
            let data = JSON.parse(this.responseText);
            let html = '';
            data.forEach(function(detail) {
                html += '<tr>';
                html += `   <td>${detail.ProductID}</td>
                    <td>${detail.ProductName}</td>
                    <td>${Number(detail.ReceivingUnitPrice).toLocaleString('en-US')}</td>
                    <td><input type="number" min = "1" value="${detail.Quantity}" style="width: 50px; text-align: center; border: 1px solid #ccc; border-radius: 4px;" oninput = "eventChangeForInputQuantiyInventoryModel(this);" onkeydown="eventKeyDownForInputQuantiyInventoryModel(event);"></td>
                    <td>${(detail.ReceivingUnitPrice*detail.Quantity).toLocaleString('en-US')}</td>
                    <td><span class="material-symbols-outlined del" onclick = "removeReceivingDetail(this);">delete</span></td>`;
                html += '</tr>';
            });
            tbody.innerHTML = html;
            updateReceivingVoucherTotal();
        } else if (this.readyState === XMLHttpRequest.DONE) {
            alert('Lỗi khi lấy dữ liệu');
        }
    };

    // Gửi request kèm theo dữ liệu
    xhr.send();

}

var deleteReceivingVoucher = (InID) => {
    if(confirm(`Bạn có chắc chắn muốn xóa phiếu nhập có mã ${InID} ra khỏi cơ sở dữ liệu?`)) {
        //Tao doi tuong xmlrequest
        let xhr = new XMLHttpRequest();

        //Thiet lap thong tin yeu cau
        xhr.open('GET', `delete-receiving-voucher.php?InID=${InID}`, true);

        // Thiết lập header cho request
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý response khi server trả về kết quả
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var data = JSON.parse(this.responseText);
                alert(data['message']);
                window.location.href = 'inventory-receiving-voucher-manager.php';
            } else if (this.readyState === XMLHttpRequest.DONE) {
                alert('Lỗi khi lấy dữ liệu');
            }
        };

        // Gửi request kèm theo dữ liệu
        xhr.send();
    }
}

var insertReceivingDetailUi = (ProductId, ProductName, ImportPrice) => {
    let receivingDetailModel = document.querySelector('.modal-inventory-container-content__table tbody');
    let trs = document.querySelectorAll('.modal-inventory-container-content__table tbody tr');
    for(let i = 0; i < trs.length; i++) {
        let tr = trs[i];
        if(tr.firstElementChild.innerText == ProductId) {
            tr.children[3].firstElementChild.value = Number(tr.children[3].firstElementChild.value) + 1;
            tr.children[4].innerText = (Number(tr.children[2].innerText.replace(/,/g, '')) * Number(tr.children[3].firstElementChild.value)).toLocaleString('en-US');
            receivingDetailModel.insertBefore(tr, trs[0]);
            updateReceivingVoucherTotal();
            resetSearchProductForReceivingVoucher();
            return;
        }
    }
    let newRow = document.createElement('tr');
    var html = '';
    html += `   <td>${ProductId}</td>
                <td>${ProductName}</td>
                <td>${ImportPrice}</td>
                <td><input type="number" min = "1" value="1" style="width: 50px; text-align: center; border: 1px solid #ccc; border-radius: 4px;" oninput = "eventChangeForInputQuantiyInventoryModel(this);" onkeydown="eventKeyDownForInputNumber(event);"></td>
                <td>${ImportPrice}</td>
                <td><span class="material-symbols-outlined del" onclick = "removeReceivingDetail(this);">delete</span></td>
            `;
    newRow.innerHTML = html;
    receivingDetailModel.insertAdjacentElement("afterbegin", newRow);

    updateReceivingVoucherTotal();

    resetSearchProductForReceivingVoucher();
}

var resetSearchProductForReceivingVoucher = () => {
    //An subnav va reset input
    let input = document.querySelector('.modal-inventory-container-content__search-input');
    let subnav = document.querySelector('.modal-inventory-container-content__search-result');

    input.value = '';
    subnav.style.display = 'none';
}

var removeReceivingDetail = (tag) => {
    let row = tag.parentNode.parentNode;
    row.parentNode.removeChild(row);
    updateReceivingVoucherTotal();
}

var eventKeyDownForInputNumber = (event) => {
    if (event.key === '-' || event.keyCode === 189 || event.which === 189 || event.key === 'e' || event.key === 'E') {
        event.preventDefault();
    }
}

var eventChangeForInputQuantiyInventoryModel = (tag) => {
    let parentNode = tag.parentNode;
    let importPrice = parentNode.previousElementSibling;
    let totalDetail = parentNode.nextElementSibling;
    if(tag.value == '') {
        totalDetail.innerText = importPrice.innerText;
        updateReceivingVoucherTotal();
        return;
    } else if(tag.value == 0) {
        tag.value = 1;
    } else {
        importPriceNum = Number(importPrice.innerText.replace(/,/g, ''));
        total = Number(importPriceNum) * Number(tag.value);
        totalDetail.innerText = total.toLocaleString('en-US');
    }
    updateReceivingVoucherTotal();
}

var updateReceivingVoucherTotal = () => {
    let total = 0;
    let total_Ui = document.querySelector('.modal-inventory-container-content__total-re');
    let trs = document.querySelectorAll('.modal-inventory-container-content__table tbody tr');
    for(let i = 0; i < trs.length; i++) {
        let tr = trs[i];
        total += Number(tr.children[4].innerText.replace(/,/g, ''));
    }
    total_Ui.innerText = `: ${total.toLocaleString('en-US')} VND`;
}

var insertReceivingVoucher = () => {
    //Check validate, if user doesn't choose supplier or a voucher must have a detail
    let err = checkValidationReceivingVoucher();
    if(err != '') {
        alert(err);
    } else if(confirm("Bạn có chắc chắn muốn thêm phiếu nhập này vào cơ sở dữ liệu?")) {
        //If validate, let insert
        //Information of receiving voucher
        let reId = document.querySelector('.modal-inventory-container-content-info__inid-re').value;
        let supplierId = document.querySelector('.modal-inventory-container-content-info__supplier-re').value.split('_')[0];
        let date = document.querySelector('.modal-inventory-container-content-info__date-re').value;
        let total = document.querySelector('.modal-inventory-container-content__total-re').innerText.split(' ')[1].replace(/,/g, '');
        
        //receiving detail
        let receivingDetailString = '';
        let trs = document.querySelectorAll('.modal-inventory-container-content__table tbody tr');
        for(let i = 0; i < trs.length; i++) {
            let tr = trs[i];
            receivingDetailString += tr.firstElementChild.innerText + '@' + tr.children[3].firstElementChild.value + '@' + tr.children[2].innerText.replace(/,/g, '');
            if(i < trs.length - 1) {
                receivingDetailString += '#';
            }
        }

        //Insert by ajax
        //Tao doi tuong xmlrequest
        let xhr = new XMLHttpRequest();

        //Thiet lap thong tin yeu cau
        xhr.open('POST', 'insert-receiving-voucher.php', true);

        // Thiết lập header cho request
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý response khi server trả về kết quả
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var data = JSON.parse(this.responseText);
                alert(data['message']);
                window.location.href = 'inventory-receiving-voucher-manager.php';
            } else if (this.readyState === XMLHttpRequest.DONE) {
                alert('Lỗi khi lấy dữ liệu');
            }
        };

        // Gửi request kèm theo dữ liệu
        var data = 'reId=' + encodeURIComponent(reId) + '&supplierId=' + encodeURIComponent(supplierId) + '&date=' + encodeURIComponent(date) + '&total=' + encodeURIComponent(total) + '&details=' + encodeURIComponent(receivingDetailString);
        xhr.send(data);
    }
}

var updateReceivingVoucher = () => {
    //Check validate, if user doesn't choose supplier or a voucher must have a detail
    let err = checkValidationReceivingVoucher();
    if(err != '') {
        alert(err);
    } else if(confirm("Bạn có chắc chắn muốn sửa phiếu nhập này trong cơ sở dữ liệu?")) {
        //If validate, let insert
        //Information of receiving voucher
        let reId = document.querySelector('.modal-inventory-container-content-info__inid-re').value;
        let supplierId = document.querySelector('.modal-inventory-container-content-info__supplier-re').value.split('_')[0];
        let date = document.querySelector('.modal-inventory-container-content-info__date-re').value;
        let total = document.querySelector('.modal-inventory-container-content__total-re').innerText.split(' ')[1].replace(/,/g, '');

        //receiving detail
        let receivingDetailString = '';
        let trs = document.querySelectorAll('.modal-inventory-container-content__table tbody tr');
        for(let i = 0; i < trs.length; i++) {
            let tr = trs[i];
            receivingDetailString += tr.firstElementChild.innerText + '@' + tr.children[3].firstElementChild.value + '@' + tr.children[2].innerText.replace(/,/g, '');
            if(i < trs.length - 1) {
                receivingDetailString += '#';
            }
        }

        //Update by ajax
        //Tao doi tuong xmlrequest
        let xhr = new XMLHttpRequest();

        //Thiet lap thong tin yeu cau
        xhr.open('POST', 'update-receiving-voucher.php', true);

        // Thiết lập header cho request
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý response khi server trả về kết quả
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var data = JSON.parse(this.responseText);
                alert(data['message']);
                window.location.href = 'inventory-receiving-voucher-manager.php';
            } else if (this.readyState === XMLHttpRequest.DONE) {
                alert('Lỗi khi lấy dữ liệu');
            }
        };

        // Gửi request kèm theo dữ liệu
        var data = 'reId=' + encodeURIComponent(reId) + '&supplierId=' + encodeURIComponent(supplierId) + '&date=' + encodeURIComponent(date) + '&total=' + encodeURIComponent(total) + '&details=' + encodeURIComponent(receivingDetailString);
        xhr.send(data);
    }
}

var checkValidationReceivingVoucher = () => {
    let err = '';
    let supplier_cb = document.querySelector('.modal-inventory-container-content-info__supplier-re');
    let trs = document.querySelectorAll('.modal-inventory-container-content__table tbody tr');
    if(supplier_cb.value == '') {
        err += 'Nhà cung cấp không được bỏ trống!';
    }

    if(trs.length == 0) {
        err += '\nMột phiếu nhập phải có tối thiểu một chi tiết!'
    }
    return err;
}

var displayOrderDetailModal = (OrderID) => {
    //Display
    let modal = document.querySelector('.modal-order');
    modal.classList.add('open');

    //Set up information of order
    //Tao doi tuong xmlrequest
    let xhr = new XMLHttpRequest();

    //Thiet lap thong tin yeu cau
    xhr.open('GET', `get-order.php?OrderID=${OrderID}`, true);

    // Thiết lập header cho request
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Xử lý response khi server trả về kết quả
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var data = JSON.parse(this.responseText);
            data.forEach(function(order) {
                let orderId_ui = document.querySelector('.modal-order-container-content-info__inid-re');
                let user_ui = document.querySelector('.modal-order-container-content-info__user-re');
                let date_ui = document.querySelector('.modal-order-container-content-info__date-re');
                let payment_ui = document.querySelector('.modal-order-container-content-info__payment-re');
                let state_ui = document.querySelector('.modal-order-container-content-info__state-re');
                let address_ui = document.querySelector('.modal-order-container-content-info__address-re');
                let total = document.querySelector('.modal-order-container-content__total-re');
                let fee_ship = document.querySelector('.modal-order-container-content__fee-re');
                let voucher = document.querySelector('.modal-order-container-content__voucher-re');
                let discount = document.querySelector('.modal-order-container-content__discount-re');
                let total_final = document.querySelector('.modal-order-container-content__payment-re');

                orderId_ui.value = order.OrderID;
                user_ui.value = order.UserID + "_" + order.FullName;
                date_ui.value = order.OderDate;
                payment_ui.value = order.PaymentName;
                state_ui.value = order.StatusName;
                address_ui.value = order.Address.replace(/#/g, ", ");
                total.innerText = Number(order.OrderTotal).toLocaleString('en-US') + "  VND";
                fee_ship.innerText = Number(order.ShippingFee).toLocaleString('en-US') + "  VND";
                voucher.innerText = order.VoucherID;
                discount.innerText = Number(order.OrderDiscount).toLocaleString('en-US') + "    VND";
                total_final.innerText = (Number(order.OrderTotal )+ Number(order.ShippingFee) - Number(order.OrderDiscount)).toLocaleString('en-US') + "    VND";
            })
        } else if (this.readyState === XMLHttpRequest.DONE) {
            alert('Lỗi khi lấy dữ liệu');
        }
    };

    // Gửi request kèm theo dữ liệu
    xhr.send();

    //Load detail
    //Tao doi tuong xmlrequest
    let xhrr = new XMLHttpRequest();

    //Thiet lap thong tin yeu cau
    xhrr.open('GET', `get-detail-orders.php?OrderID=${OrderID}`, true);

    // Thiết lập header cho request
    xhrr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Xử lý response khi server trả về kết quả
    xhrr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            let tbody = document.querySelector('.modal-order-container-content__table tbody');
            let data = JSON.parse(this.responseText);
            let html = '';
            data.forEach(function(detail) {
                html += '<tr>';
                html += `   <td>${detail.ProductID}</td>
                    <td>${detail.ProductName}</td>
                    <td>${Number(detail.UnitPrice).toLocaleString('en-US')}</td>
                    <td>${detail.Quantity}</td>
                    <td>${(detail.UnitPrice*detail.Quantity).toLocaleString('en-US')}</td>`;
                html += '</tr>';
            });
            tbody.innerHTML = html;
        } else if (this.readyState === XMLHttpRequest.DONE) {
            alert('Lỗi khi lấy dữ liệu');
        }
    };

    // Gửi request kèm theo dữ liệu
    xhrr.send();
}

var checkOrderDateSearch = () => {
    let dateFrom = document.querySelector('.order-search__date-from').valueAsDate;
    let dateTo = document.querySelector('.order-search__date-to').valueAsDate;
    if(dateFrom > dateTo) {
        alert('Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!');
        return false;
    }
    return true;
}

var updateOrder = (select) => {
    let notification = '';
    if(select.value.split('_')[0] == 'S05') {
        notification = "Khi đơn hàng đã hủy thì không thể khôi phục! Bạn có chắc chắn muốn hủy đơn hàng này?";
    } else {
        notification = "Bạn có chắc chắn muốn cập nhật tình trạng đơn hàng này?";
    }

    if(confirm(notification)) {
        //Tao doi tuong xmlrequest
        let xhr = new XMLHttpRequest();

        //Thiet lap thong tin yeu cau
        xhr.open('GET', `update-order-status.php?OrderID=${select.getAttribute("orderId")}&OrderStatusID=${select.value.split('_')[0]}`, true);

        // Thiết lập header cho request
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý response khi server trả về kết quả
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var data = JSON.parse(this.responseText);
                alert(data['message']);
                window.location.reload();
            } else if (this.readyState === XMLHttpRequest.DONE) {
                alert('Lỗi khi lấy dữ liệu');
            }
        };

        // Gửi request kèm theo dữ liệu
        xhr.send();
    }
}

var displayModalStatistic = () => {
    let search_input = document.querySelector('.statistic-stock-search__input');
    let currentDate = new Date();
    let year = currentDate.getFullYear();
    let month = String(currentDate.getMonth() + 1).padStart(2, '0');
    let day = String(currentDate.getDate()).padStart(2, '0');

    let formattedDate = year + '-' + month + '-' + day;
    if(new Date(document.querySelector('.statistic-stock__date').value) > new Date(formattedDate)) {
        alert("Ngày được chọn phải nhỏ hơn hoặc bằng ngày hiện tại!");
    } else if(search_input.disabled) {
        let modal = document.querySelector('.modal-statistic');
        modal.classList.add('open');

        //Set up
        let search_value_arr = search_input.value.split('@@');
        let heading = document.querySelector('.modal-statistic-container-content__heading');
        let img = document.querySelector('.modal-statistic-container-content_img > img');
        let product_name = document.querySelector('.modal-statistic-container-content__name');
        let date = document.querySelector('.modal-statistic-container-content__date-re');
        let quantity = document.querySelector('.modal-statistic-container-content__quantity-re');

        heading.innerText = search_value_arr[1];
        img.src = `./assets/Img/productImg/${search_value_arr[2]}`;
        product_name.innerText = search_value_arr[0];
        let date_input = document.querySelector('.statistic-stock__date');
        let selectedDate = new Date(date_input.value);
  
        let day = String(selectedDate.getDate()).padStart(2, '0');
        let month = String(selectedDate.getMonth() + 1).padStart(2, '0');
        let year = selectedDate.getFullYear();
        
        let formattedDate = day + '-' + month + '-' + year;
        date.innerText = ": " + formattedDate;

        //Tao doi tuong xmlrequest
        let xhr = new XMLHttpRequest();

        //Thiet lap thong tin yeu cau
        xhr.open('GET', `get-product-quantity.php?ProductID=${search_value_arr[1]}&Date=${date_input.value}`, true);

        // Thiết lập header cho request
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Xử lý response khi server trả về kết quả
        xhr.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                var data = JSON.parse(this.responseText);
                if(data.length === 0) {
                    quantity.innerText = ': không có dữ liệu tồn kho tại thời điểm này';
                } else {
                    data.forEach(function(item) {
                        quantity.innerText = ': ' + item.Quantity;
                    })
                }
            } else if (this.readyState === XMLHttpRequest.DONE) {
                alert('Lỗi khi lấy dữ liệu');
            }
        };

    // Gửi request kèm theo dữ liệu
    xhr.send();

    } else {
        alert("Vui lòng chọn một sản phẩm để xem tồn kho!");
    }
    
}

var checkDateForStatisticSearch = () => {
    let dateFrom = document.querySelector('.product-sale-search__date-from').valueAsDate;
    let dateTo = document.querySelector('.product-sale-search__date-to').valueAsDate;
    if(dateFrom > dateTo) {
        alert('Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc!');
        return false;
    }
    return true;
}