{OVERALL_HEADER}
<style>
    .quickad-template{
        margin: 20px;
        font-family: Roboto,"Helvetica Neue",Helvetica,Arial,sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .PaymentMethod-content-inner {
        position: relative;
        padding: 16px 24px 24px;
        border-radius: 0 0 3px 3px;
        background-color: #fff;
    }
    .quickad-template .default-table {
        width: 100%!important;
        border: none;
        border-collapse: collapse;
    }
    .PaymentMethod-infoTable {
        margin-bottom: 24px;
    }

    .quickad-template .default-table tbody {
        border: none;
        border-bottom: 1px solid #DEDEDE;
    }
    .quickad-template .default-table.table-alt-row tr:nth-child(even) {
        background-color: #F0F0F0;
    }
    .quickad-template .default-table tbody tr {
        border-top: 1px solid #DEDEDE;
        border-left: 1px solid #DEDEDE;
        border-right: 1px solid #DEDEDE;
        -webkit-transition: all .2s ease-out;
        transition: all .2s ease-out;
    }
    .quickad-template .default-table tbody tr:hover {
        -webkit-transition: all .2s ease-out;
        transition: all .2s ease-out;
        background-color: #dbf4ff!important;
        border: 1px solid #75d5ff!important;
    }
    .quickad-template .default-table tbody td {
        vertical-align: top;
    }
    .quickad-template .default-table td, .quickad-template .default-table th {
        padding: 13px;
    }
    .PaymentMethod-heading {
        font-size: 14px;
        line-height: 1.43;
        margin-bottom: 4px;
        color: #1f2836;
        font-weight: bold;
    }
    .PaymentMethod-label {
        border-radius: 3px 3px 0 0;
        font-size: 20px;
        font-weight: 700;
        color: #F7F7F7;
        background-color: #000;
        padding: 15px;
    }
    .PaymentMethod-info{font-size: 14px;
        line-height: 1.4;
        color: #1f2836;}
    .PaymentMethod-info b{font-weight: 600;}
</style>


<div class="container">

    <div class="quickad-template">
        <div class="PaymentMethod-label">
            <span><i class="fa fa-university" aria-hidden="true"></i> Deposit by Cheque</span>
        </div>
        <div class="PaymentMethod-content-inner">
            <div class="alert alert-success">

                {LANG_OFFLINE_PAYMENT_REQUEST}
            </div>
            <table class="default-table table-alt-row PaymentMethod-infoTable">
                <tbody>
                    <tr>
                        <td>
                            <h5 class="PaymentMethod-heading">Cheque Information</h5>
                            <span class="PaymentMethod-info">
                                Please send your cheque for {CURRENCY_SIGN}{AMOUNT} to the following address:<br><br>
                                {CHEQUE_INFO}
                                <br>


                                Make your cheque payable to <strong>{PAYABLE_TO}</strong></span>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="PaymentMethod-heading">Reference</h5>
                            <span class="PaymentMethod-info">
                                Cheque Deposit to <b>{SITE_TITLE}</b>.<br>
                                <b>Order Title</b>: {ORDER_TITLE}<br>
                                <b>Username</b>: {USERNAME}<br>
                                <b>Transaction id</b>: {TRANSACTION_ID}<br><br>

                                Include a note with Reference so that we know which account to credit.
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5 class="PaymentMethod-heading">Amount to send</h5>
                            <span class="PaymentMethod-info">{CURRENCY_SIGN}{AMOUNT} {CURRENCY_CODE}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align: right"><a href="{LINK_INDEX}" class="btn btn-primary">Dashboard</a></div>
        </div>
    </div>
</div>
{OVERALL_FOOTER}