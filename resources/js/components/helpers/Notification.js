class Notification {

    success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Added Successfully !',
            timeout: 1500,
        }).show();
    }

    salary_success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Paid Successfully !',
            timeout: 1500,
        }).show();
    }

    cart_success() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Add to Cart!',
            timeout: 1500,
        }).show();
    }

    cart_delete() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Cart Deleted!',
            timeout: 1500,
        }).show();
    }

    editSuccess() {
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Updated Successfully !',
            timeout: 1500,
        }).show();
    }


    error() {
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Some Went Wrong !',
            timeout: 1000,
        }).show();
    }

    warning() {
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Opps Something Wrong !',
            timeout: 1000,
        }).show();
    }

    image_validation() {
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Uploaded Image will be less than 2MB.',
            timeout: 1500,
        }).show();
    }

}

export default Notification = new Notification();