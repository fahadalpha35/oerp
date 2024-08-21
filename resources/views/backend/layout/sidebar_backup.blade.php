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
                <i class="mdi mdi-cogs  menu-icon"></i>&nbsp;
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
                <i class="mdi mdi-account-check menu-icon"></i>
                <span class="menu-title">Human Resource</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="hr">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="">Employee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Leave Application</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Attendance Tracking</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Payroll</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Recruitment</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Training & Development</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Employee Self-Service</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Documents</a></li>
                    <li class="nav-item"> <a class="nav-link" href="">Employee Benefits</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="#humanResource" data-toggle="collapse" aria-expanded="false" >
                <i class="mdi mdi-account-check menu-icon"></i>
                <span class="menu-title">Human Resource</span>
                <i class="menu-arrow"></i>
            </a>
            
            <!-- First-level sub-menu -->
            <ul class="collapse nav" id="humanResource" style="margin-top: -2px;">
              <li class="nav-item">
                <a class="nav-link" href="#Employee" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Employee</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3" id="Employee" style="margin-top: -2px;">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Employee List</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Add Employee</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Employee Profile</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#LeaveApplication" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Leave Application</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3" id="LeaveApplication" style="margin-top: -2px;">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Apply For Leave</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Review Application</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Leave Application List</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                </ul>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#AttendanceTracking" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Attendance Tracking</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3" id="AttendanceTracking" style="margin-top: -2px;">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Give Attendance</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Attendance List</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#Payroll" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Payroll</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3" id="Payroll" style="margin-top: -2px;">
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Add Pyroll</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="mdi mdi-adjust menu-icon"></i>
                    <span class="menu-title">Payroll List</span>
                    <i class="menu-arrow"></i>
                    </a>
                  </li>

                </ul>
              </li>


            
            </ul>
          </li>



        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#im" aria-expanded="false" aria-controls="im">
                <i class="mdi mdi-warehouse menu-icon"></i>
                <span class="menu-title">Inventory</span>
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
                <i class="mdi mdi-puzzle menu-icon"></i>
                <span class="menu-title">Manufacturing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="manu">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="">Production</a></li>
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
                <i class="mdi mdi-codepen menu-icon"></i>
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
                <i class="mdi mdi-file-tree menu-icon"></i>
                <span class="menu-title">Supply Chain Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="scm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Suppliers</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Logistics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Inventory Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Procurement</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Demand Planning</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Supplier Performance</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Transport</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Warehouses</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Reports</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Settings</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#fa" aria-expanded="false" aria-controls="fa">
                <i class="mdi mdi-finance menu-icon"></i>
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
                <i class="mdi mdi-cash-multiple menu-icon"></i>
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
                <i class="mdi mdi-account-switch menu-icon"></i>
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
                <i class="mdi mdi-chart-pie menu-icon"></i>
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
                <i class="mdi mdi-book-multiple menu-icon"></i>
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
            <a class="nav-link" data-toggle="collapse" href="#ec" aria-expanded="false" aria-controls="ec">
                <i class="mdi mdi-cart  menu-icon"></i>
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
                <i class="mdi mdi-home-city menu-icon"></i>
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
                <i class="mdi mdi-account-group menu-icon"></i>
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
                <i class="mdi mdi-file-document menu-icon"></i>
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
                <i class="mdi mdi-web menu-icon"></i>
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
                <i class="mdi mdi-cellphone-link menu-icon"></i>
                <span class="menu-title">Digital Marketing</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="dm">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="campaignManagementToggle">
                            <span class="menu-title">Campaign Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="campaign-management">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="#">Create Campaign</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Manage Campaigns</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Campaign Templates</a></li>
                            </ul>
                        </div>
                    </li>
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

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
                <i class="mdi mdi-pencil-box-outline menu-icon"></i>
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
            <a class="nav-link" href="#mainMenu1" data-toggle="collapse" aria-expanded="false">
              <i class="icon-home"></i> Main Menu 1
            </a>
            <!-- First-level sub-menu -->
            <ul class="collapse nav flex-column" id="mainMenu1">
              <li class="nav-item">
                <a class="nav-link" href="#subMenu1" data-toggle="collapse" aria-expanded="false">
                  <i class="icon-folder"></i> Sub Menu 1
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3" id="subMenu1">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Sub Menu Item 1</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Sub Menu Item 2</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Another Item</a>
              </li>
            </ul>
          </li>
        
      
    </ul>
</nav>
