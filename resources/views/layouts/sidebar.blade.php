<div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <ul class="navigation-left">
        <li class="nav-item" data-item="dashboard">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x fa-calendar-check"></i>
                <span class="nav-text">Calendar</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="finances">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x fa-money"></i>
                <span class="nav-text">Finances</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="communications">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x fa-phone"></i>
                <span class="nav-text">Communications</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="projects">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x project-diagram"></i>
                <span class="nav-text">Projects</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="contacts">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x fa-users"></i>
                <span class="nav-text">Contacts</span>
            </a>
            <div class="triangle"></div>
        </li>
        <li class="nav-item" data-item="files">
            <a class="nav-item-hold" href="#">
                <i class="fa fa-2x fa-file"></i>
                <span class="nav-text">Files</span>
            </a>
            <div class="triangle"></div>
        </li>
    </ul>
</div>
<div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
    <i class="sidebar-close i-Close" (click)="toggelSidebar()"></i>
    <header>
        <div class="logo">
            <img src="{{asset('images/logo.png')}}" alt="">
        </div>
    </header>
    <!-- Submenu Appointments -->
    <div class="submenu-area" data-parent="dashboard">
        <header>
            <h6>Calendar</h6>
            <p>View events</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('appointments')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Events</span>
                </a>
                <a href="{{url('appointments/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Create Event</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Submenu Invoices -->
    <div class="submenu-area" data-parent="finances">
        <header>
            <h6>Accounts</h6>
            <p>Manage your accounts</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('accounts')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Accounts</span>
                </a>
                <a href="{{url('accounts/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Create Account</span>
                </a>
            </li>
        </ul>
        <header>
            <h6>Invoices</h6>
            <p>Manage your invoices</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('invoices')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Invoices</span>
                </a>
                <a href="{{url('invoices/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Issue Invoice</span>
                </a>
            </li>
        </ul>
        <header>
            <h6>Expenses</h6>
            <p>Manage your expenses</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('expenses')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Expenses</span>
                </a>
                <a href="{{url('expenses/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Issue Expense</span>
                </a>
            </li>
        </ul>
        <header>
            <h6>Transactions</h6>
            <p>Manage your transactions</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('transactions')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Transactions</span>
                </a>
                <a href="{{url('transactions/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Issue Transaction</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Submenu Communications -->
    <div class="submenu-area" data-parent="communications">
        <header>
            <h6>Communications</h6>
            <p>Manage your Communications</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('topics')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Communications</span>
                </a>
                <a href="{{url('topics')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Start New Communication</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Submenu Projects -->
    <div class="submenu-area" data-parent="projects">
        <header>
            <h6>Projects</h6>
            <p>Manage your Projects</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('projects')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Projects</span>
                </a>
                <a href="{{url('projects/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">New Project</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Submenu Contact -->
    <div class="submenu-area" data-parent="contacts">
        <header>
            <h6>Contacts</h6>
            <p>Manage Contacts</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('contacts')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Contacts</span>
                </a>
                <a href="{{url('contacts/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Add Contact</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Submenu Files -->
    <div class="submenu-area" data-parent="files">
        <header>
            <h6>Files</h6>
            <p>Manage Files</p>
        </header>
        <ul class="childNav">
            <li class="nav-item">
                <a href="{{url('files')}}">
                    <i class="fa fa-eye"></i>&nbsp;
                    <span class="item-name">View Files</span>
                </a>
                <a href="{{url('files/create')}}">
                    <i class="fa fa-plus"></i>&nbsp;
                    <span class="item-name">Upload File</span>
                </a>
            </li>
        </ul>
    </div>
</div>