// JavaScript Document
function checkCategoryForm()
{
    with (window.document.frmCategory) {
		if (isEmpty(txtReference, 'Enter category reference')) {
			return;
//		} else if (isEmpty(mtxDescription, 'Enter category description')) {
//			return;
		} else {
			submit();
		}
	}
}

function addCategory(parentId)
{
	targetUrl = 'index.php?view=add';
	if (parentId != 0) {
		targetUrl += '&parentId=' + parentId;
	}
	
	window.location.href = targetUrl;
}

function modifyCategory(catId)
{
	window.location.href = 'index.php?view=modify&catId=' + catId;
}

function deleteCategory(catId)
{
	if (confirm('Deleting category will also delete all products in it.\nContinue anyway?')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
	}
}

function deleteImage(catId)
{
	if (confirm('Delete this image?')) {
		window.location.href = 'processCategory.php?action=deleteImage&catId=' + catId;
	}
}

function deleteLanguageItem(lang, item, categoryId)
{
        if (confirm('Delete this language item?')) {
                window.location.href = 'processCategory.php?action=deleteLanguageItem&lang=' + lang + '&item=' + item + '&catId=' + categoryId;
        }
}

