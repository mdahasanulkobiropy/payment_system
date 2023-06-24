		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{asset('dashboards')}}/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Rukada</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                    <ul>
                        @if (Auth::user()->role == 'admin')
                            <li> <a href="{{route('admin.create.user.show')}}"><i class="bx bx-right-arrow-alt"></i>User List</a> </li>
                            <li> <a href="{{route('admin.transaction')}}"><i class="bx bx-right-arrow-alt"></i>Transaction</a> </li>
                            <li> <a href="{{route('admin.create.user.index')}}"><i class="bx bx-right-arrow-alt"></i>Create user</a>
                            </li>
                            <li> <a href="{{route('admin.distribute.agent.index')}}"><i class="bx bx-right-arrow-alt"></i>Distribute-Agent</a>
                            </li>
                            <li> <a href="{{route('admin.distribute.bank.index')}}"><i class="bx bx-right-arrow-alt"></i>Distribute-Bank</a>
                            </li>

                        @elseif (Auth::user()->role == 'user')
                            <li> <a href="{{route('user.sendMoney.index')}}"><i class="bx bx-right-arrow-alt"></i>Send Money</a>
                            </li>
                            <li> <a href="{{route('user.cashOut.index')}}"><i class="bx bx-right-arrow-alt"></i>Cash Out</a> </li>
                            <li> <a href="{{route('myTransctionUser')}}"><i class="bx bx-right-arrow-alt"></i>myTransction</a> </li>

                        @elseif (Auth::user()->role == 'agent')
                            <li> <a href="{{route('agent.agentBank.index')}}"><i class="bx bx-right-arrow-alt"></i>Agent to Bank</a>
                            </li>
                            <li> <a href="{{route('agent.agentAdmin.index')}}"><i class="bx bx-right-arrow-alt"></i>Agent to Admin</a> </li>
                            <li> <a href="{{route('myTransctionAgent')}}"><i class="bx bx-right-arrow-alt"></i>myTransction</a> </li>
                        @elseif (Auth::user()->role == 'bank')
                            <li> <a href="{{route('bank.bankAdmin.index')}}"><i class="bx bx-right-arrow-alt"></i>Bank to Admin</a> </li>
                            <li> <a href="{{route('myTransctionBank')}}"><i class="bx bx-right-arrow-alt"></i>myTransction</a> </li>
                        @endif
                    </ul>
                </li>
			</ul>

			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
