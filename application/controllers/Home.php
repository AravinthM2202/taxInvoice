<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller {

    // constructor
    function __construct() {
        parent::__construct();
    }

    // Home Listing Method
    public function index() {
        $title = array("title" => "Tax Invoice", "subTitle" => "Home");
        $this->load->view('includes/header-includes', $title);
        $this->load->view('home');
    }

    // Listing Invoice List
    public function invoiceList() {
        $columns = array(
            array(
                'db' => 'id',
                'dt' => 0,
                'formatter' => function($d, $row) {
                    return "";
                }
            ),
            array('db' => 'invoiceId', 'dt' => 1),
            array('db' => 'invoiceName', 'dt' => 2),
            array('db' => 'grandTotal', 'dt' => 3),
            array(
                'db' => 'createdDate',
                'dt' => 4,
                'formatter' => function($d, $row) {
                    return date("d/m/Y h:i:s A", strtotime($d));
                }
            ),
            array(
                'db' => 'invoiceStatus',
                'dt' => 5,
                'formatter' => function($d, $row) {
                    if($d == 1) {
                        $status = '<span class="bg-success px-3 py-1 text-light">Active</span>'; 
                    } else {
                        $status = '<span class="bg-danger px-3 py-1 text-light">Inactive</span>'; 
                    }
                    return $status;
                }
            ),
            array(
                'db' => 'id',
                'dt' => 6,
                'formatter' => function($d, $row) {
                    $invoiceId = base64_encode($d);
                    $printAction = '<a href="' . base_url('home/viewInvoiceDetail/' . $invoiceId) . '" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate Invoice"><i class="fa fa-print" aria-hidden="true"></i></a>';
                    return $printAction;
                }
            )
        );
    
        $sqlDetails = array(
            'host' => DB_HOST,
            'user' => DB_USERNAME,
            'pass' => DB_PASSWORD,
            'db'   => DB_NAME,    
        );

        require( 'ssp.class.php' );
 
        echo json_encode(
            SSP::simple( $_GET, $sqlDetails, DB_INVOICE, 'id', $columns )
        );
    }

    // Create Invoice Page Load
    public function createInvoice() {
        $title = array("title" => "Tax Invoice", "subTitle" => "Create");
        $this->load->view('includes/header-includes', $title);
        $this->load->view('createInvoice');
    }

    // Add Invoice Details to Database
    public function addInvoiceDetails() {
        $itemName = implode("|", $this->input->post('itemName'));
        $itemQuantity = implode("|", $this->input->post('quantity'));
        $itemUnitPrice = implode("|", $this->input->post('unitPrice'));

        $itemTotalArray = calculateItemTotals($this->input->post('quantity'), $this->input->post('unitPrice'), $this->input->post('taxPercentage'), $this->input->post('discount'), $this->input->post('discountType'));

        $fields = array(
            "invoiceId" => "Invoice_" . date("Ymdhis"),
            "invoiceName" => $this->input->post('invoiceName'),
            "itemName" => $itemName,
            "itemQuantity" => $itemQuantity,
            "itemUnitPrice" => $itemUnitPrice,
            "itemTotalPrice" => $itemTotalArray['totalPrice'],
            "taxPercentage" => $this->input->post('taxPercentage'),
            "taxAmount" => $itemTotalArray['taxAmount'],
            "subTotalWithoutTax" => $itemTotalArray['subTotalWithoutTax'],
            "subTotalWithTax" => $itemTotalArray['subTotalWithTax'],
            "discount" => $itemTotalArray['discount'],
            "grandTotal" => $itemTotalArray['grandTotal'],
            "createdDate" => date("Y-m-d H:i:s"),
        );

        $where = array("id" => "");
        $result = $this->TaxInvoice_model->updateData($fields, DB_INVOICE, $where);
        if($result == 1) {
            $response = array("status" => 1, "message" => "Invoice details added successfully.");
        } else {
            $response = array("status" => 0, "message" => "Error in updating invoice details. Please contact the administrator.");
        }
        print_r(json_encode($response));
        exit;
    }

    // View / Print Invoice Details
    public function viewInvoiceDetail() {
        $title = array("title" => "Tax Invoice", "subTitle" => "View");

        $invoiceId = $this->uri->segment(3);

        if(empty($invoiceId)) {
            redirect(BASE_PATH);
        }

        $invoiceWhere = array("id" => base64_decode($invoiceId));
        $invoiceFetchArray = $this->TaxInvoice_model->getDataWhere(DB_INVOICE, $invoiceWhere);

        if(count($invoiceFetchArray) == 0) {
            redirect(BASE_PATH);
        }

        $invoiceArray = reset($invoiceFetchArray);
        $data = array_merge($invoiceArray);

        $this->load->view('includes/header-includes', $title);
        $this->load->view('viewInvoiceDetail', $data);
    }
}
