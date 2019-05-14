/*This method is called when the input file change.
This one does some validations and 
if everything is ok it enables the send button*/

$('#input-file').change(function () {
    var inputFile = $(this);
    hideErrorMessage();
    if ($(inputFile).get(0).files.length > 0) {
        if (isAllowedExtension(getExtension($(inputFile).val()))){
            if ($(inputFile).get(0).files[0].size <= 3145728) { //Increase or decrease the size. It's initialed with 3mb. 1 megabyte = 1048576 bytes
                var reader = new FileReader();
                reader.onload = function(e) { $('#image-to-upload').attr('src', e.target.result); };
                reader.readAsDataURL($(this).get(0).files[0]);
                $('#btn-upload-image').prop('disabled', false);
            }
            else{
                showErrorMessage('Max file size is exceeded'); removeImageToUpload(); //Message to display when the file size is exceeded
            }
        }else{
            showErrorMessage('The file type is not allowed'); removeImageToUpload(); //Message to display when the file extension is not allowed
        }
    }
});


//This method hides the image displayed in the div
//and change the src attribute from the image element
function removeImageToUpload(){
    $('#image-to-upload').attr('src', '');
    $('#btn-upload-image').prop('disabled', true);
}


//This method hides the element where the error message is displayed
function hideErrorMessage(){
    if (!$('#error-message-id').hasClass('hidden')) { $('#error-message-id').addClass('hidden'); }
}


//This method displays the element where the error message is displayed
function showErrorMessage(message){
    $('#error-message-id').text(message);
    if ($('#error-message-id').hasClass('hidden')) { $('#error-message-id').removeClass('hidden'); }
}


//This method validates if the file extension is allowed
function isAllowedExtension(extension){
    var error = true;
    var allowedExtension = ['.png','.jpg','.jpeg','.gif','.svg']; //Include or remove extensions
    if (!allowedExtension.includes(extension)) { error = false; }
    return error;
}


//This method get the file extension
function getExtension(path){
    var indexOf = path.lastIndexOf('.');
    return path.substr(indexOf, path.length).toLowerCase();
}