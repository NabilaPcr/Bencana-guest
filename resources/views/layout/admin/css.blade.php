<style>
        /* ===== RESET & FONT ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7fbf7;
            color: #2b2b2b;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ===== NAVBAR ===== */
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 15px 20px;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2e6d38;
        }

        .navbar .logo i {
            font-size: 2rem;
            color: #56a65a;
        }

        .navbar .logo span {
            color: #7ac27b;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            font-weight: 500;
            color: #2e6d38;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #56a65a;
        }

        .btn-login {
            background: #56a65a;
            color: white !important;
            padding: 10px 22px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #48904d;
        }

        /* ===== MAIN CONTENT ===== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            gap: 20px;
        }

        .header-text h1 {
            color: #2e6d38;
            font-size: 2.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-text p {
            color: #666;
        }

        .btn-add {
            background: #24af5a;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .btn-add:hover {
            background: #1e8d4a;
            transform: translateY(-2px);
        }

        /* ===== TABLE STYLES ===== */
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        .users-table th {
            background: #2e6d38;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            border: none;
        }

        /* Atur lebar kolom yang lebih proporsional */
        .users-table th:nth-child(1) { width: 20%; } /* NAME */
        .users-table th:nth-child(2) { width: 35%; } /* EMAIL */
        .users-table th:nth-child(3) { width: 30%; } /* PASSWORD */
        .users-table th:nth-child(4) { width: 15%; } /* ACTION */

        .users-table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            word-wrap: break-word;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .users-table tr:hover {
            background: #f9fff9;
        }

        .user-name {
            font-weight: 600;
            color: #2e6d38;
        }

        .user-email {
            color: #666;
            word-wrap: break-word;
        }

        .password-hash {
            font-family: monospace;
            font-size: 0.8rem;
            color: #888;
            word-break: break-all;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-buttons {
            display: flex;
            gap: 2px;
            flex-wrap: nowrap;
        }

        .btn-action {
            padding: 8px 10px;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-edit {
            background: #f39c12;
            color: white;
        }

        .btn-edit:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: #999;
            margin-bottom: 10px;
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #2e6d38;
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 60px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .users-table th:nth-child(1) { width: 25%; }
            .users-table th:nth-child(2) { width: 35%; }
            .users-table th:nth-child(3) { width: 25%; }
            .users-table th:nth-child(4) { width: 15%; }

            .password-hash {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .header-text h1 {
                font-size: 1.8rem;
            }

            .btn-add {
                justify-content: center;
            }

            .table-container {
                padding: 20px;
                overflow-x: auto;
            }

            .users-table {
                min-width: 700px;
            }

            .users-table th:nth-child(1) { width: 20%; }
            .users-table th:nth-child(2) { width: 30%; }
            .users-table th:nth-child(3) { width: 30%; }
            .users-table th:nth-child(4) { width: 20%; }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn-action {
                font-size: 0.75rem;
                padding: 6px 10px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 15px;
            }

            .users-table {
                min-width: 600px;
            }

            .users-table th:nth-child(1) { width: 25%; }
            .users-table th:nth-child(2) { width: 35%; }
            .users-table th:nth-child(3) { width: 20%; }
            .users-table th:nth-child(4) { width: 20%; }
        }
    </style>
