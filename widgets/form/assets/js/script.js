$(document).on('submit', '.review-form', function () {
    const self = $(this);
    const btn = self.find('.ladda-button');
    const modal = self.parents('.modal');
    btn.ladda();
    btn.ladda('start');
    $.post(self.attr('action'), self.serialize()).always(function (result) {
        btn.ladda('remove');
        if (result.status) {
            $.growl.error({
                title: '',
                message: result.message,
                style: 'notice',
            });
            self.get(0).reset();
            if (modal) {
                modal.modal('hide');
            }
        } else if (result.error) {
            $.growl.error({
                title: '',
                message: result.error,
                style: 'error',
            });
        }
    });
    return false;
});