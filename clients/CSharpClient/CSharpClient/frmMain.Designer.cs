namespace CSharpClient
{
    partial class frmMain
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.cmdGetTests = new System.Windows.Forms.Button();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.txtLogin = new System.Windows.Forms.TextBox();
            this.txtPassword = new System.Windows.Forms.TextBox();
            this.tblTests = new System.Windows.Forms.DataGridView();
            this.label3 = new System.Windows.Forms.Label();
            this.txtBaseURL = new System.Windows.Forms.TextBox();
            this.label4 = new System.Windows.Forms.Label();
            this.cmdLatestStatus = new System.Windows.Forms.Button();
            this.Id = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.TestName = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Creator = new System.Windows.Forms.DataGridViewTextBoxColumn();
            this.Description = new System.Windows.Forms.DataGridViewTextBoxColumn();
            ((System.ComponentModel.ISupportInitialize)(this.tblTests)).BeginInit();
            this.SuspendLayout();
            // 
            // cmdGetTests
            // 
            this.cmdGetTests.Location = new System.Drawing.Point(232, 50);
            this.cmdGetTests.Name = "cmdGetTests";
            this.cmdGetTests.Size = new System.Drawing.Size(75, 23);
            this.cmdGetTests.TabIndex = 0;
            this.cmdGetTests.Text = "Get Tests";
            this.cmdGetTests.UseVisualStyleBackColor = true;
            this.cmdGetTests.Click += new System.EventHandler(this.cmdGetTests_Click);
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(19, 58);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(53, 13);
            this.label1.TabIndex = 1;
            this.label1.Text = "Password";
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(19, 31);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(33, 13);
            this.label2.TabIndex = 2;
            this.label2.Text = "Login";
            // 
            // txtLogin
            // 
            this.txtLogin.Location = new System.Drawing.Point(103, 28);
            this.txtLogin.Name = "txtLogin";
            this.txtLogin.Size = new System.Drawing.Size(100, 20);
            this.txtLogin.TabIndex = 3;
            this.txtLogin.Text = "bbalet";
            // 
            // txtPassword
            // 
            this.txtPassword.Location = new System.Drawing.Point(103, 55);
            this.txtPassword.Name = "txtPassword";
            this.txtPassword.PasswordChar = '*';
            this.txtPassword.Size = new System.Drawing.Size(100, 20);
            this.txtPassword.TabIndex = 4;
            this.txtPassword.Text = "bbalet";
            // 
            // tblTests
            // 
            this.tblTests.AllowUserToAddRows = false;
            this.tblTests.AllowUserToDeleteRows = false;
            this.tblTests.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.tblTests.Columns.AddRange(new System.Windows.Forms.DataGridViewColumn[] {
            this.Id,
            this.TestName,
            this.Creator,
            this.Description});
            this.tblTests.Location = new System.Drawing.Point(16, 77);
            this.tblTests.MultiSelect = false;
            this.tblTests.Name = "tblTests";
            this.tblTests.SelectionMode = System.Windows.Forms.DataGridViewSelectionMode.FullRowSelect;
            this.tblTests.Size = new System.Drawing.Size(647, 195);
            this.tblTests.TabIndex = 5;
            this.tblTests.CellDoubleClick += new System.Windows.Forms.DataGridViewCellEventHandler(this.tblTests_CellDoubleClick);
            this.tblTests.SelectionChanged += new System.EventHandler(this.tblTests_SelectionChanged);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(19, 8);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(56, 13);
            this.label3.TabIndex = 6;
            this.label3.Text = "Base URL";
            // 
            // txtBaseURL
            // 
            this.txtBaseURL.Location = new System.Drawing.Point(103, 1);
            this.txtBaseURL.Name = "txtBaseURL";
            this.txtBaseURL.Size = new System.Drawing.Size(363, 20);
            this.txtBaseURL.TabIndex = 7;
            this.txtBaseURL.Text = "http://localhost/sokun/api/";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(16, 287);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(347, 13);
            this.label4.TabIndex = 8;
            this.label4.Text = "Double-click on a row so as to see the steps associated to this test case";
            // 
            // cmdLatestStatus
            // 
            this.cmdLatestStatus.Enabled = false;
            this.cmdLatestStatus.Location = new System.Drawing.Point(313, 50);
            this.cmdLatestStatus.Name = "cmdLatestStatus";
            this.cmdLatestStatus.Size = new System.Drawing.Size(92, 23);
            this.cmdLatestStatus.TabIndex = 9;
            this.cmdLatestStatus.Text = "Latest status";
            this.cmdLatestStatus.UseVisualStyleBackColor = true;
            this.cmdLatestStatus.Click += new System.EventHandler(this.cmdLatestStatus_Click);
            // 
            // Id
            // 
            this.Id.HeaderText = "Id";
            this.Id.Name = "Id";
            // 
            // TestName
            // 
            this.TestName.HeaderText = "TestName";
            this.TestName.Name = "TestName";
            // 
            // Creator
            // 
            this.Creator.HeaderText = "Creator";
            this.Creator.Name = "Creator";
            // 
            // Description
            // 
            this.Description.HeaderText = "Description";
            this.Description.Name = "Description";
            // 
            // frmMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(701, 312);
            this.Controls.Add(this.cmdLatestStatus);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.txtBaseURL);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.tblTests);
            this.Controls.Add(this.txtPassword);
            this.Controls.Add(this.txtLogin);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.cmdGetTests);
            this.Name = "frmMain";
            this.Text = "Sokun .net client";
            ((System.ComponentModel.ISupportInitialize)(this.tblTests)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button cmdGetTests;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.TextBox txtLogin;
        private System.Windows.Forms.TextBox txtPassword;
        private System.Windows.Forms.DataGridView tblTests;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.TextBox txtBaseURL;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Button cmdLatestStatus;
        private System.Windows.Forms.DataGridViewTextBoxColumn Id;
        private System.Windows.Forms.DataGridViewTextBoxColumn TestName;
        private System.Windows.Forms.DataGridViewTextBoxColumn Creator;
        private System.Windows.Forms.DataGridViewTextBoxColumn Description;
    }
}

