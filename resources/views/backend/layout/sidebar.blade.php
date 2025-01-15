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
                            @elseif(Request::is('leave_types')) show
                            @elseif(Request::is('apply_leave')) show
                            @elseif(Request::is('leave_applications')) show
                            @elseif(Request::is('leave_application_approval_list')) show
                            @elseif(Request::is('give_attendance')) show
                            @elseif(Request::is('exit_attendance')) show
                            @elseif(Request::is('attendances')) show
                            @elseif(Request::is('fingerprint_portal')) show
                            @elseif(Request::is('payrolls')) show
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
                        <span class="menu-arrow" style="{{ Request::is('employees') ? 'color: white; !important' : ''}}">Employees</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('branches') }}" class="nav-link {{ Request::is('branches') ? 'active' : '' }}" style="{{ Request::is('branches') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('branches') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('branches') ? 'color: white; !important' : ''}}">Branches</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('departments') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}" style="{{ Request::is('departments') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('departments') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('departments') ? 'color: white; !important' : ''}}">Departments</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('designations') }}" class="nav-link {{ Request::is('designations') ? 'active' : '' }}" style="{{ Request::is('designations') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('designations') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('designations') ? 'color: white; !important' : ''}}">Designations</span>
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
                <ul class="collapse nav flex-column ms-3 @if(Request::is('leave_types')) show
                            @elseif(Request::is('apply_leave')) show
                            @elseif(Request::is('leave_applications')) show
                            @elseif(Request::is('leave_application_approval_list')) show
                            @endif" id="LeaveApplication" style="margin-top: -2px;">

                {{-- <ul class="collapse nav flex-column ms-3" id="LeaveApplication" style="margin-top: -2px;"> --}}
                @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (Auth::user()->role_id == 3))
                  <li class="nav-item">
                    <a href="{{ url('leave_types') }}" class="nav-link {{ Request::is('leave_types') ? 'active' : '' }}" style="{{ Request::is('leave_types') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('leave_types') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('leave_types') ? 'color: white; !important' : ''}}">Leave Types</span>
                      </a>
                  </li>
                @endif
                  <li class="nav-item">
                    <a href="{{ url('apply_leave') }}" class="nav-link {{ Request::is('apply_leave') ? 'active' : '' }}" style="{{ Request::is('apply_leave') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('apply_leave') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('apply_leave') ? 'color: white; !important' : ''}}">Apply For Leave</span>
                      </a>
                  </li>
                  @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (Auth::user()->role_id == 3))
                  <li class="nav-item">
                    <a href="{{ url('leave_application_approval_list') }}" class="nav-link {{ Request::is('leave_application_approval_list') ? 'active' : '' }}" style="{{ Request::is('leave_application_approval_list') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('leave_application_approval_list') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('leave_application_approval_list') ? 'color: white; !important' : ''}}">Review Application</span>
                      </a>
                  </li>
                @endif

                  <li class="nav-item">
                    <a href="{{ url('leave_applications') }}" class="nav-link {{ Request::is('leave_applications') ? 'active' : '' }}" style="{{ Request::is('leave_applications') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('leave_applications') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('leave_applications') ? 'color: white; !important' : ''}}">Leave Applications</span>
                      </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#attendanceTrackingMenu" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Attendance Tracking</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('give_attendance')) show
                            @elseif(Request::is('exit_attendance')) show
                            @elseif(Request::is('attendances')) show
                            @elseif(Request::is('fingerprint_portal')) show
                            @endif" id="attendanceTrackingMenu" style="margin-top: -2px;">

                @if((Auth::user()->role_id != 1) && (Auth::user()->role_id != 2))
                    <li class="nav-item">
                        <a href="{{ url('give_attendance') }}" class="nav-link {{ Request::is('give_attendance') ? 'active' : '' }}" style="{{ Request::is('give_attendance') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                            <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('give_attendance') ? 'color: white; !important' : ''}}"></i>
                            <span class="menu-arrow" style="{{ Request::is('give_attendance') ? 'color: white; !important' : ''}}">Entry</span>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ url('exit_attendance') }}" class="nav-link {{ Request::is('exit_attendance') ? 'active' : '' }}" style="{{ Request::is('exit_attendance') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('exit_attendance') ? 'color: white; !important' : ''}}">Exit</span>
                    </a>
                    </li>
                @endif

                <li class="nav-item">
                  <a href="{{ url('attendances') }}" class="nav-link {{ Request::is('attendances') ? 'active' : '' }}" style="{{ Request::is('attendances') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                      <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('attendances') ? 'color: white; !important' : ''}}"></i>
                      <span class="menu-arrow" style="{{ Request::is('attendances') ? 'color: white; !important' : ''}}">Attendances</span>
                    </a>
                </li>
                @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (Auth::user()->role_id == 3))
                <li class="nav-item">
                    <a href="{{ url('fingerprint_portal') }}" class="nav-link {{ Request::is('fingerprint_portal') ? 'active' : '' }}" style="{{ Request::is('fingerprint_portal') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('fingerprint_portal') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('fingerprint_portal') ? 'color: white; !important' : ''}}">FingerPrint</span>
                      </a>
                  </li>
                  @endif
                </ul>
              </li>


              <li class="nav-item">
                <a href="{{ url('payrolls') }}" class="nav-link {{ Request::is('payrolls') ? 'active' : '' }}" style="{{ Request::is('payrolls') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                    <i class="mdi mdi-checkbox-blank-circle-outline menu-icon" style="{{ Request::is('payrolls') ? 'color: white; !important' : ''}}"></i>
                    <span class="menu-arrow" style="{{ Request::is('payrolls') ? 'color: white; !important' : ''}}">Payrolls</span>
                  </a>
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



          <!-- Society Management (start)-->
          <li class="nav-item">
            <a class="nav-link" href="#societyManagement" data-toggle="collapse" aria-expanded="">
                <i class="mdi mdi-account-check menu-icon"></i>
                <span class="menu-title">Society Management</span>
                <i class="menu-arrow"></i>
            </a>

            <!-- First-level sub-menu -->
            <ul class="collapse nav  @if(Request::is('society_members')) show
                                    @elseif(Request::is('renewal_fees')) show
                                    @elseif(Request::is('society_committees')) show
                                    @elseif(Request::is('committee_members')) show
                                    @elseif(Request::is('society_events')) show
                                    @elseif(Request::is('fund_collections')) show
                                    @elseif(Request::is('event_sponsorships')) show
                                    @elseif(Request::is('society_insurances')) show
                                    @elseif(Request::is('society_member_loans')) show
                                    @elseif(Request::is('loan_repayment_list')) show
                                    @elseif(Request::is('event_tickets')) show
                                    @elseif(Request::is('sold_event_tickets')) show
                                    @elseif(Request::is('society_expense_type_list')) show
                                    @elseif(Request::is('society_expenses')) show
                                    @elseif(Request::is('society_expense_report')) show
                                    @elseif(Request::is('society_profit_and_loss')) show
                                    @elseif(Request::is('budget_and_collected_fund')) show
                            @endif" id="societyManagement" style="margin-top: -2px; padding-bottom : 10px">

            @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (Auth::user()->role_id == 3))
            <li class="nav-item">
                <a href="{{ url('society_members') }}" class="nav-link {{ Request::is('society_members') ? 'active' : '' }}" style="{{ Request::is('society_members') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_members') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('society_members') ? 'color: white; !important' : ''}}">Society Members</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('renewal_fees') }}" class="nav-link {{ Request::is('renewal_fees') ? 'active' : '' }}" style="{{ Request::is('renewal_fees') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('renewal_fees') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('renewal_fees') ? 'color: white; !important' : ''}}">Renewal Fees</span>
                </a>
             </li>

            <li class="nav-item">
                <a class="nav-link" href="#Committee" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Committee</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('society_committees')) show
                            @elseif(Request::is('committee_members')) show
                            @endif" id="Committee" style="margin-top: -2px; padding-bottom : 10px">

                  <li class="nav-item">
                    <a href="{{ url('society_committees') }}" class="nav-link {{ Request::is('society_committees') ? 'active' : '' }}" style="{{ Request::is('society_committees') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_committees') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('society_committees') ? 'color: white; !important' : ''}}">Committees</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('committee_members') }}" class="nav-link {{ Request::is('committee_members') ? 'active' : '' }}" style="{{ Request::is('committee_members') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('committee_members') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('committee_members') ? 'color: white; !important' : ''}}">Committee Members</span>
                      </a>
                  </li>

                </ul>
              </li>

              <li class="nav-item">
                <a href="{{ url('society_events') }}" class="nav-link {{ Request::is('society_events') ? 'active' : '' }}" style="{{ Request::is('society_events') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_events') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('society_events') ? 'color: white; !important' : ''}}">Society Events</span>
                </a>
             </li>
             <li class="nav-item">
                <a href="{{ url('fund_collections') }}" class="nav-link {{ Request::is('fund_collections') ? 'active' : '' }}" style="{{ Request::is('fund_collections') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('fund_collections') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('fund_collections') ? 'color: white; !important' : ''}}">Fund Collections</span>
                </a>
             </li>

             <li class="nav-item">
                <a href="{{ url('event_sponsorships') }}" class="nav-link {{ Request::is('event_sponsorships') ? 'active' : '' }}" style="{{ Request::is('event_sponsorships') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('event_sponsorships') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('event_sponsorships') ? 'color: white; !important' : ''}}">Sponsorships</span>
                </a>
             </li>

             <li class="nav-item">
                <a href="{{ url('society_insurances') }}" class="nav-link {{ Request::is('society_insurances') ? 'active' : '' }}" style="{{ Request::is('society_insurances') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_insurances') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('society_insurances') ? 'color: white; !important' : ''}}">Insurances</span>
                </a>
             </li>

             <li class="nav-item">
                <a href="{{ url('society_member_loans') }}" class="nav-link {{ Request::is('society_member_loans') ? 'active' : '' }}" style="{{ Request::is('society_member_loans') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_member_loans') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('society_member_loans') ? 'color: white; !important' : ''}}">Member Loans</span>
                </a>
             </li>

             <li class="nav-item">
                <a href="{{ url('loan_repayment_list') }}" class="nav-link {{ Request::is('loan_repayment_list') ? 'active' : '' }}" style="{{ Request::is('loan_repayment_list') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('loan_repayment_list') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('loan_repayment_list') ? 'color: white; !important' : ''}}">Loan Repayments</span>
                </a>
             </li>

             <!--society ticket -->
             <li class="nav-item">
                <a class="nav-link" href="#SocietyEventTicket" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Event Ticket</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('event_tickets')) show
                            @elseif(Request::is('sold_event_tickets')) show
                            @endif" id="SocietyEventTicket" style="margin-top: -2px; padding-bottom : 10px">
                
                  <li class="nav-item">
                    <a href="{{ url('event_tickets') }}" class="nav-link {{ Request::is('event_tickets') ? 'active' : '' }}" style="{{ Request::is('event_tickets') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('event_tickets') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('event_tickets') ? 'color: white; !important' : ''}}">Event Tickets</span>
                      </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ url('sold_event_tickets') }}" class="nav-link {{ Request::is('sold_event_tickets') ? 'active' : '' }}" style="{{ Request::is('sold_event_tickets') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('sold_event_tickets') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('sold_event_tickets') ? 'color: white; !important' : ''}}">Sold Tickets</span>
                      </a>
                  </li>
                </ul>
              </li>

            <!--society expense -->
             <li class="nav-item">
                <a class="nav-link" href="#SocietyExpense" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Expense</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('society_expense_type_list')) show
                            @elseif(Request::is('society_expenses')) show
                            @elseif(Request::is('society_expense_report')) show
                            @endif" id="SocietyExpense" style="margin-top: -2px; padding-bottom : 10px">
                
                  <li class="nav-item">
                    <a href="{{ url('society_expense_type_list') }}" class="nav-link {{ Request::is('society_expense_type_list') ? 'active' : '' }}" style="{{ Request::is('society_expense_type_list') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_expense_type_list') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('society_expense_type_list') ? 'color: white; !important' : ''}}">Expense Types</span>
                      </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ url('society_expenses') }}" class="nav-link {{ Request::is('society_expenses') ? 'active' : '' }}" style="{{ Request::is('society_expenses') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_expenses') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('society_expenses') ? 'color: white; !important' : ''}}">Expenses</span>
                      </a>
                  </li>

                  <li class="nav-item">
                    <a href="{{ url('society_expense_report') }}" class="nav-link {{ Request::is('society_expense_report') ? 'active' : '' }}" style="{{ Request::is('society_expense_report') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_expense_report') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('society_expense_report') ? 'color: white; !important' : ''}}">Expense Report</span>
                      </a>
                  </li>

                </ul>
              </li>



            <!--society accounts -->
             <li class="nav-item">
                <a class="nav-link" href="#SocietyAccounts" data-toggle="collapse" aria-expanded="false">
                  <i class="mdi mdi-checkbox-blank-circle-outline  menu-icon"></i>
                <span class="menu-title">Accounts</span>
                <i class="menu-arrow"></i>
                </a>
                <!-- Second-level sub-menu -->
                <ul class="collapse nav flex-column ms-3 @if(Request::is('society_profit_and_loss')) show
                            @elseif(Request::is('budget_and_collected_fund')) show
                            @endif" id="SocietyAccounts" style="margin-top: -2px; padding-bottom : 10px">
                
                  <li class="nav-item">
                    <a href="{{ url('society_profit_and_loss') }}" class="nav-link {{ Request::is('society_expenses') ? 'active' : '' }}" style="{{ Request::is('society_profit_and_loss') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_profit_and_loss') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('society_profit_and_loss') ? 'color: white; !important' : ''}}">Profit And Loss</span>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{ url('budget_and_collected_fund') }}" class="nav-link {{ Request::is('society_expenses') ? 'active' : '' }}" style="{{ Request::is('budget_and_collected_fund') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('budget_and_collected_fund') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('budget_and_collected_fund') ? 'color: white; !important' : ''}}">Budget v/s Fund</span>
                    </a>
                  </li>



                </ul>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ url('society_accounts') }}" class="nav-link {{ Request::is('society_insurances') ? 'active' : '' }}" style="{{ Request::is('society_accounts') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('society_accounts') ? 'color: white; !important' : ''}}"></i>
                <span class="menu-arrow" style="{{ Request::is('society_accounts') ? 'color: white; !important' : ''}}">Profit And Loss</span>
                </a>
                </li> --}}
            @endif

            </ul>
          </li>

          <!-- Society Member (end)-->


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#im" aria-expanded="false" aria-controls="im">
                <i class="mdi mdi-warehouse menu-icon"></i>
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="im">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('item.index') }}">Item Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}">Product Category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Product Managment</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manufac" aria-expanded="false" aria-controls="manu">
                <i class="mdi mdi-puzzle menu-icon"></i>
                <span class="menu-title">Manufacture</span>
                <i class="menu-arrow"></i>
            </a>

                <ul class="collapse nav  @if(Request::is('manufacturing')) show
                            @elseif(Request::is('service')) show
                            @elseif(Request::is('parts')) show
                            @elseif(Request::is('order')) show
                            @elseif(Request::is('production')) show
                            @elseif(Request::is('workorder')) show
                            @endif" id="manufac" style="margin-top: -2px;">
                <li class="nav-item">
                    <a href="{{ url('service') }}" class="nav-link {{ Request::is('service') ? 'active' : '' }}" style="{{ Request::is('service') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('service') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('service') ? 'color: white; !important' : ''}}">Service Type</span>
                      </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('manufacturing') }}" class="nav-link {{ Request::is('manufacturing') ? 'active' : '' }}" style="{{ Request::is('manufacturing') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('manufacturing') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('manufacturing') ? 'color: white; !important' : ''}}">Clients</span>
                      </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ url('purchase-return') }}" class="nav-link {{ Request::is('parts') ? 'active' : '' }}" style="{{ Request::is('parts') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('parts') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('parts') ? 'color: white; !important' : ''}}">Parts</span>
                      </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ url('order') }}" class="nav-link {{ Request::is('order') ? 'active' : '' }}" style="{{ Request::is('order') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('order') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('order') ? 'color: white; !important' : ''}}">Work Orders</span>
                      </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('production') }}" class="nav-link {{ Request::is('production') ? 'active' : '' }}" style="{{ Request::is('production') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('production') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('production') ? 'color: white; !important' : ''}}">Production</span>
                      </a>
                </li><br>
                <!-- <li class="nav-item">
                    <a href="{{ url('workorder') }}" class="nav-link {{ Request::is('workorder') ? 'active' : '' }}" style="{{ Request::is('workorder') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('workorder') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('workorder') ? 'color: white; !important' : ''}}">Work Orders</span>
                      </a>
                </li><br> -->
                </ul>

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
            <a class="nav-link" data-toggle="collapse" href="#suppliChain" aria-expanded="false" aria-controls="suppliChain">
                <i class="mdi mdi-puzzle menu-icon"></i>
                <span class="menu-title">Supplychain Managment</span>
                <i class="menu-arrow"></i>
            </a>

                <ul class="collapse nav  @if(Request::is('supplychain')) show
                            @elseif(Request::is('purchase')) show
                            @elseif(Request::is('purchase-return')) show
                            @elseif(Request::is('supplychain')) show
                            @endif" id="suppliChain" style="margin-top: -2px;">
                <li class="nav-item">
                    <a href="{{ url('supplychain') }}" class="nav-link {{ Request::is('supplychain') ? 'active' : '' }}" style="{{ Request::is('supplychain') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('supplychain') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('supplychain') ? 'color: white; !important' : ''}}">Supplier Managements</span>
                      </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('purchase') }}" class="nav-link {{ Request::is('purchase') ? 'active' : '' }}" style="{{ Request::is('purchase') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('purchase') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('purchase') ? 'color: white; !important' : ''}}">Purchases</span>
                      </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('purchase-return') }}" class="nav-link {{ Request::is('purchase-return') ? 'active' : '' }}" style="{{ Request::is('purchase-return') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('purchase-return') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('purchase-return') ? 'color: white; !important' : ''}}">Purchases Return</span>
                      </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('order') }}" class="nav-link {{ Request::is('order') ? 'active' : '' }}" style="{{ Request::is('order') ? 'background-color: #908ec4; color: white; margin-right:5px; !important' : ''}}">
                        <i class="mdi mdi-adjust menu-icon" style="{{ Request::is('order') ? 'color: white; !important' : ''}}"></i>
                        <span class="menu-arrow" style="{{ Request::is('order') ? 'color: white; !important' : ''}}">Supplier Payment</span>
                      </a>
                </li>
            </ul>

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
