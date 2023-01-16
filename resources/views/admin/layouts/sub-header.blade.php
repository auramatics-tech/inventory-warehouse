<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    @if (Route::is('admin.dashboard')=='admin.dashboard') Dashboard 
                    @elseif (Route::is('admin.branch')=='admin.branch') Branches 
                    @elseif (Route::is('admin.create_branch')=='admin.create_branch') Create Branch
                    @elseif (Route::is('admin.edit_branch')=='admin.edit_branch') Edit Branch
                    @elseif (Route::is('admin.shelve')=='admin.shelve') Shelves 
                    @elseif (Route::is('admin.create_shelve')=='admin.shelve') Create Shelve 
                    @elseif (Route::is('admin.edit_shelve')=='admin.shelve') Edit Shelve 
                    @elseif (Route::is('admin.technician')=='admin.technician') Technicians 
                    @elseif (Route::is('admin.create_technician')=='admin.technician') Create Technician 
                    @elseif (Route::is('admin.edit_technician')=='admin.technician') Edit Technician 
                    @elseif (Route::is('admin.category')=='admin.category') Categories 
                    @elseif (Route::is('admin.create_category')=='admin.category') Create Category 
                    @elseif (Route::is('admin.edit_category')=='admin.category') Edit Category 
                    @elseif (Route::is('admin.product')=='admin.product') Products 
                    @elseif (Route::is('admin.create_product')=='admin.product') Create Product 
                    @elseif (Route::is('admin.edit_product')=='admin.product') Edit Product 
                    @elseif (Route::is('admin.user')=='admin.user') Users 
                    @elseif (Route::is('admin.create_user')=='admin.user') Create User 
                    @elseif (Route::is('admin.edit_user')=='admin.user') Edit User 
                    @elseif (Route::is('admin.supplier')=='admin.supplier') Suppliers 
                    @elseif (Route::is('admin.create_supplier')=='admin.create_supplier') Create Supplier
                    @elseif (Route::is('admin.edit_supplier')=='admin.edit_supplier') Update Supplier
                    @elseif (Route::is('admin.invoice')=='admin.invoice') Invoices 
                    @elseif (Route::is('admin.edit_invoice')=='admin.edit_invoice') Edit Invoice 
                    @elseif (Route::is('admin.new_invoice')=='admin.new_invoice') New Invoice 
                    @elseif (Route::is('admin.profile')=='admin.profile') Edit Profile
                    @endif
                <!--begin::Description-->
                <!-- <small class="text-muted fs-7 fw-bold my-1 ms-1">#XRS-45670</small> -->
                <!--end::Description-->
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>