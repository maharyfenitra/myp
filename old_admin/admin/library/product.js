// JavaScript Document
function viewProduct()
{
	with (window.document.frmListProduct) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}

function checkAddProductForm()
{
	with (window.document.frmAddProduct) {
		if (cboCategory.selectedIndex == 0) {
			alert('Choose the product category');
			cboCategory.focus();
			return;
		} else if (isEmpty(txtName, 'Enter Product name')) {
			return;
		} else {
			submit();
		}
	}
}

function addProduct(catId)
{
	window.location.href = 'index.php?view=add&catId=' + catId;
}

function cloneProduct(productId)
{
        window.location.href = 'index.php?view=clone&productId=' + productId;
}

function modifyProduct(productId)
{
	window.location.href = 'index.php?view=modify&productId=' + productId;
}

function deleteProduct(productId, catId)
{
        if (confirm('Delete this product?')) {
                window.location.href = 'processProduct.php?action=deleteProduct&productId=' + productId + '&catId=' + catId;
        }
}
function deleteProductItem(productItemId, productId)
{
	if (confirm('Delete this product item?')) {
		window.location.href = 'processProduct.php?action=deleteProductItem&productItemId=' + productItemId + '&productId=' + productId;
	}
}

function deleteLanguageItem(lang, item, productId)
{
        if (confirm('Delete this language item?')) {
                window.location.href = 'processProduct.php?action=deleteLanguageItem&lang=' + lang + '&item=' + item + '&productId=' + productId;
        }
}



function deleteImage(productId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processProduct.php?action=deleteImage&productId=' + productId;
	}
}
