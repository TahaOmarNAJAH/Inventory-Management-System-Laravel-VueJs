class Notification {

    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done !',
            timeout: 1000,
        }).show();
    }

    alert() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are You Sure ?',
            timeout: 1000,
        }).show();
    }

    error() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Somthing Went Wrong !',
            timeout: 1000,
        }).show();
    }

    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Opps Wrong !',
            timeout: 1000,
        }).show();
    }

    imageValidation() {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Image Size is Higher than 1MB !',
            timeout: 2000,
        }).show();
    }

    cartSuccess(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Added To Cart',
            timeout: 2000,
        }).show();
    }
}

export default Notification = new Notification();