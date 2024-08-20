<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('backend/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/update-admin-password') }}">Update Password</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/update-admin-details') }}">Update Details</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#hr" aria-expanded="false" aria-controls="hr">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Human Resource</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hr">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="">Employee Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Leave Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Attendance Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Payroll Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Recruitment and Onboarding</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Performance Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Training and Development</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Employee Self-Service</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Document Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Employee Benefits Management</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#im" aria-expanded="false" aria-controls="im">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Inventory Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="im">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="">Stock Levels</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Reorder Points</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Product Catalog</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Suppliers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Purchase Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Sales Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Inventory Adjustments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Stock Transfers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manu" aria-expanded="false" aria-controls="manu">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Manufacturing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="">Production Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Quality Control</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Work Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Bill of Materials (BOM)</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Routing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Manufacturing Resources</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Maintenance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Production Reporting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Production Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#prod" aria-expanded="false" aria-controls="prod">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Production</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="prod">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Production Overview</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Production Schedule</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Quality Control</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Work Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Material Requirements</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Production Costs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Resource Allocation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Production Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Maintenance Schedules</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#scm" aria-expanded="false" aria-controls="scm">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Supply Chain Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="scm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Supplier Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Logistics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inventory Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Order Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Procurement</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Demand Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Supplier Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Transport Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Warehouse Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#fa" aria-expanded="false" aria-controls="fa">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Finance & Accounts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="fa">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Accounts Payable</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Accounts Receivable</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Financial Statements</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">General Ledger</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Bank Reconciliation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Payroll</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Expense Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Budgeting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Tax Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Financial Analysis</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Accounts Settings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pos" aria-expanded="false" aria-controls="pos">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Sales & Marketing (POS)</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pos">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Sales Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Marketing Campaigns</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Product Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">POS Transactions</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Discounts & Promotions</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Sales Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Campaign Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Loyalty Programs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inventory Integration</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#crm" aria-expanded="false" aria-controls="crm">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Customer Relation Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="crm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Database</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Support</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Lead Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Sales Pipeline</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Segmentation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Campaign Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Interaction History</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Feedback & Surveys</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports & Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Integrations</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Membership Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#plan" aria-expanded="false" aria-controls="plan">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Planning</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="plan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Project Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Resource Allocation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Timeline Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Task Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Budget Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Risk Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Milestone Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Gantt Charts</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Dependency Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Progress Monitoring</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reporting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pm" aria-expanded="false" aria-controls="pm">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Project Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Project Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Task Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Project Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Resource Allocation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Budget Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Risk Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Milestones</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Project Documentation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Gantt Charts</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Issue Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Team Collaboration</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reporting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Reporting</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Monthly Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Annual Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Financial Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Sales Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inventory Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Project Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Performance Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Operational Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Compliance Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Custom Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Analytics Dashboard</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Export Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Report Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ec" aria-expanded="false" aria-controls="ec">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">e-Commerce</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ec">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Product Listings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Order Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Category Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inventory Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Pricing & Discounts</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Shipping & Delivery</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Payment Gateways</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Promotions & Coupons</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Sales Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Returns & Refunds</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reviews & Ratings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Support</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#rent" aria-expanded="false" aria-controls="rent">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Rental</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="rent">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Rental Agreements</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Asset Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Tenant Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Lease Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Payment Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Maintenance Requests</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inspection Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Renewals & Extensions</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Property Listings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Utility Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Rental History</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports & Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#serv" aria-expanded="false" aria-controls="serv">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Service</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="serv">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Service Overview</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Support</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Requests</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Scheduling</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Contracts</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Technician Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Feedback</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Knowledge Base</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports & Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Service Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#doc" aria-expanded="false" aria-controls="doc">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Documentation</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="doc">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">API Documentation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">User Guides</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Release Notes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Technical Manuals</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Knowledge Base</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Installation Guides</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Configuration Guides</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Troubleshooting</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">FAQs</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Best Practices</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Document Templates</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Version History</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Document Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#web" aria-expanded="false" aria-controls="web">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Website</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="web">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Website Overview</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Content Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">User Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Page Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Media Library</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">SEO Settings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Site Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Theme Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Plugin Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Security Settings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Backup & Restore</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Performance Optimization</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">User Roles & Permissions</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Comments & Feedback</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Website Settings</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Blog Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">eCommerce</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">eLearning</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#dm" aria-expanded="false" aria-controls="dm">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Digital Marketing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="dm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Campaign Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">SEO Strategies</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Social Media Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Email Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Content Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Pay-Per-Click (PPC) Advertising</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Affiliate Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Conversion Rate Optimization (CRO)</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Lead Generation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Market Research</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Brand Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Digital Asset Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Campaign Reports</a></li>
                </ul>
            </div>
        </li>

        
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Form elements</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ url('backend/pages/forms/basic_elements.html') }}">Basic Elements</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
            <i class="icon-bar-graph menu-icon"></i>
            <span class="menu-title">Charts</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/charts/chartjs.html') }}">ChartJs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Tables</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/tables/basic-table.html') }}">Basic table</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Icons</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/icons/mdi.html') }}">Mdi icons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">User Pages</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/samples/login.html') }}"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/samples/register.html') }}"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
            <i class="icon-ban menu-icon"></i>
            <span class="menu-title">Error pages</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="error">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/samples/error-404.html') }}"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('backend/pages/samples/error-500.html') }}"> 500 </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('backend/pages/documentation/documentation.html') }}">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Documentation</span>
            </a>
        </li> -->
    </ul>
</nav>
