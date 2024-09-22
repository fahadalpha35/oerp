<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="@if(Request::is('update-password')) true
                      @elseif(Request::is('update-personal-details')) true
                      @else false
                      @endif" aria-controls="ui-basic">
                <i class="mdi mdi-cogs  menu-icon"></i>&nbsp;
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a href="{{ url('update-password') }}" class="nav-link {{ Request::is('update-password') ? 'active' : '' }}" style="{{ Request::is('update-password') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                            <span class="menu-arrow" style="{{ Request::is('update-password') ? 'color: white; !important' : ''}}">Update Password</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('update-personal-details') }}" class="nav-link {{ Request::is('update-personal-details') ? 'active' : '' }}" style="{{ Request::is('update-personal-details') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                            <span class="menu-arrow" style="{{ Request::is('update-personal-details') ? 'color: white; !important' : ''}}">Update Personal Details</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ url('update-admin-details') }}">Update Personal Details</a></li> --}}
                </ul>
            </div>
        </li>


        <li class="nav-item ">
            <a class="nav-link" href="#humanResource" data-toggle="collapse"  aria-expanded="">
                <i class="mdi mdi-account-check menu-icon"></i>
                <span class="menu-title">Human Resource</span>
                <i class="menu-arrow"></i>
            </a>
            
            <!-- First-level sub-menu -->
            <ul class="collapse nav  @if(Request::is('employees')) show
                            @elseif(Request::is('designations')) show
                            @elseif(Request::is('branches')) show
                            @elseif(Request::is('departments')) show
                            @endif" id="humanResource" style="margin-top: -2px;">

              <li class="nav-item">            
                <a class="nav-link" href="#Employee" data-toggle="collapse" 
                     aria-expanded="">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Employee</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('employees')) show
                            @elseif(Request::is('designations')) show
                            @elseif(Request::is('branches')) show
                            @elseif(Request::is('departments')) show
                            @endif" id="Employee" style="margin-top: -2px;">
                  
                <li class="nav-item">
                    <a href="{{ url('employees') }}" class="nav-link {{ Request::is('employees') ? 'active' : '' }}" style="{{ Request::is('employees') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('employees') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('employees') ? 'color: white; !important' : ''}}">Employee List</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('employees/create') }}" class="nav-link {{ Request::is('employees/create') ? 'active' : '' }}" style="{{ Request::is('employees/create') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('employees/create') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('employees/create') ? 'color: white; !important' : ''}}">Add Employee</span>

                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('employees') }}" class="nav-link {{ Request::is('employees') ? 'active' : '' }}" style="{{ Request::is('employees') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('employees') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('employees') ? 'color: white; !important' : ''}}">Employee Profile</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('branches') }}" class="nav-link {{ Request::is('branches') ? 'active' : '' }}" style="{{ Request::is('branches') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('branches') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('branches') ? 'color: white; !important' : ''}}">Branch</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('departments') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}" style="{{ Request::is('departments') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('departments') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('departments') ? 'color: white; !important' : ''}}">Department</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('designations') }}" class="nav-link {{ Request::is('designations') ? 'active' : '' }}" style="{{ Request::is('designations') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('designations') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('designations') ? 'color: white; !important' : ''}}">Designation</span>
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
              
                <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                    <span class="menu-title">Recruitment</span>
                    <i class="menu-arrow"></i>
                    </a>         
                </li>

                <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                        <span class="menu-title">Performance</span>
                        <i class="menu-arrow"></i>
                        </a>         
                </li>

                <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                        <span class="menu-title">Training & Development</span>
                        <i class="menu-arrow"></i>
                        </a>         
                </li>

                {{-- <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                        <span class="menu-title">Employee Self-Service</span>
                        <i class="menu-arrow"></i>
                        </a>         
                </li> --}}

                <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                        <span class="menu-title">Documents</span>
                        <i class="menu-arrow"></i>
                        </a>         
                </li>

                <li class="nav-item"> 
                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                        <span class="menu-title">Employee Benefits</span>
                        <i class="menu-arrow"></i>
                        </a><br>         
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
                <span class="menu-title">Manufacture</span>
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

                <span class="menu-title">CRM</span>
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
                    <li class="nav-item"> <a class="nav-link" href="#">Customer Membership</a></li>
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
            <a class="nav-link" data-toggle="collapse" href="#ec" aria-expanded="false" aria-controls="ec">
                <i class="mdi mdi-cart menu-icon"></i>
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
                    <li class="nav-item"> <a class="nav-link" href="#">Campaign Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Analytics</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">SEO Strategies</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Social Media Management</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Email Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Content Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Pay-Per-Click Advertising</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Affiliate Marketing</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Conversion Rate Optimization</a></li>
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
        </li> -->
        <!-- <li class="nav-item">
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
