$(document).ready(function () {
    // TAGS
    var tags = new Tags($('#bankaccountTags'));

    // EDIT ONLY
    if ( ! window.bankaccountModal) {
        // AMOUNT
        new Amount($('#amountEditWrapper'), $('#account_id'));

        return;
    }

    var expenseButton = $('#expenseButton'),
        incomeButton = $('#incomeButton'),
        bankaccountModalContainer = $('#bankaccountModalContainer'),
        bankaccountModal = $('#bankaccountModal'),
        postURL = bankaccountModal.data('posturl');

    // MODAL
    var bankaccountModalObject = new Modal(bankaccountModalContainer, {
        onConfirmEvent: function (modal) {
            modal.actionsDisabled = true;

            postTransaction(modal);
        }
    });

    // SENDS TRANSACTION
    var bankaccountLoader = $('#bankaccountModalLoader'),
        bankaccountFlash = $('#bankaccountFlashMessage');

    function postTransaction() {
        $('#bankaccountModalLoader').addClass('bankaccount-modal__loader--active');

        $.post(
            postURL,
            serializeFormInformation(),
            function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    bankaccountModalObject.actionsDisabled = false;

                    bankaccountLoader.removeClass('bankaccount-modal__loader--active');
                    bankaccountFlash.addClass('bankaccount-modal__flash--active');
                    bankaccountFlash.text(data.message);
                }
            },
            'json'
        );
    }

    // OPEN CREATE MODAL
    expenseButton.click(function () {
        initializeTransactionModal();
        return false;
    });

    incomeButton.click(function () {
        initializeTransactionModal('income');
        return false;
    });

    function initializeTransactionModal(type) {
        resetTransactionModal();

        if(type === 'income') {
            bankaccountModal.removeClass('bankaccount-modal--expense');
            bankaccountModal.addClass('bankaccount-modal--income');
            bankaccountType.val('income');
        } else {
            bankaccountModal.removeClass('bankaccount-modal--income');
            bankaccountModal.addClass('bankaccount-modal--expense');
            bankaccountType.val('expense');
        }

        bankaccountModal.children('.scroller').perfectScrollbar('update');

        bankaccountModalObject.openModal();
    }

    // INPUTS
    var bankaccountType = $('#t_type'),
        bankaccountName = $('#t_name'),
        bankaccountAmount = $('#t_amount'),
        bankaccountAccount = $('#t_account_id'),
        bankaccountDate = $('#t_date'),
        bankaccountReceived = $('input[name="t_received"]'),
        bankaccountTags = $('#t_tags'),
        bankaccountNotes = $('#t_notes');

    // AMOUNT FIELD
    var amountField = new Amount($('#amountWrapper'), bankaccountAccount);

    // RESET MODAL
    function resetTransactionModal() {
        bankaccountFlash.removeClass('bankaccount-modal__flash--active');

        bankaccountName.val('');
        bankaccountAccount.val(window.currentAccount);
        // Amount should be after account
        amountField.flush();
        bankaccountDate.val(new Date().toJSON().slice(0,10));
        bankaccountReceived.prop('checked', true);
        tags.flush();
        bankaccountNotes.val('');
    }

    // SERIALIZE FORM INFO
    function serializeFormInformation() {
        return {
            'name': bankaccountName.val(),
            'type': bankaccountType.val(),
            'amount': bankaccountAmount.val() == '' ? 0 : bankaccountAmount.val(),
            'account_id': bankaccountAccount.val(),
            'created_at': bankaccountDate.val(),
            'received': bankaccountReceived.is(':checked') ? 1 : 0,
            'tags': bankaccountTags.val(),
            'notes': bankaccountNotes.val()
        }
    }
});

// DATE FIELDS
$.datetimepicker.setLocale(window.locale);
$('.form-group--datetime').each(function() {
    $(this).find('input[type="text"]').datetimepicker({
        format:'Y-m-d H:i:s'
    });
});