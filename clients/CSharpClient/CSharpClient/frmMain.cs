using System;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.Net;
using System.Windows.Forms;
using Newtonsoft.Json;

namespace CSharpClient
{
    public partial class frmMain : Form
    {
        public frmMain()
        {
            InitializeComponent();
        }

        /// <summary>
        /// On double click on a datatable cell, load the test steps from REST API
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void tblTests_CellDoubleClick(object sender, DataGridViewCellEventArgs e)
        {
            int l_intTestID = Convert.ToInt32(this.tblTests.Rows[e.RowIndex].Cells[0].Value.ToString());
            string l_strStepsURL = "tests/" + l_intTestID + "/steps";
            using (WebClient l_objClient = new WebClient())
            {
                l_objClient.BaseAddress = txtBaseURL.Text;
                try
                {
                    byte[] l_objResponse = l_objClient.UploadValues(l_strStepsURL, new NameValueCollection()
                   {
                       { "login", txtLogin.Text },
                       { "password", txtPassword.Text }
                   });
                    string l_strResult = System.Text.Encoding.UTF8.GetString(l_objResponse);
                    List<Step> l_lstTestSteps = JsonConvert.DeserializeObject<List<Step>>(l_strResult);
                    frmStepsView l_objFrmStepsView = new frmStepsView(l_lstTestSteps);
                    l_objFrmStepsView.ShowDialog();
                }
                catch (WebException l_objException)
                {
                    MessageBox.Show(l_objException.Message);
                }
            }
        }

        /// <summary>
        /// Get the list of tests (REST API)
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void cmdGetTests_Click(object sender, EventArgs e)
        {
            using (WebClient l_objClient = new WebClient())
            {
                l_objClient.BaseAddress = txtBaseURL.Text;
                try
                {
                   byte[] l_objResponse = l_objClient.UploadValues("tests", new NameValueCollection()
                   {
                       { "login", txtLogin.Text },
                       { "password", txtPassword.Text }
                   });
                    string l_strResult = System.Text.Encoding.UTF8.GetString(l_objResponse);
                    List<Test> l_lstTests = JsonConvert.DeserializeObject<List<Test>>(l_strResult);
                    this.tblTests.Rows.Clear();
                    foreach (Test l_objTest in l_lstTests)
                    {
                        tblTests.Rows.Add(l_objTest.Id,
                            l_objTest.Name,
                            l_objTest.Creator_Name,
                            l_objTest.Description);
                    }
                }
                catch (WebException l_objException)
                {
                    MessageBox.Show(l_objException.Message);
                }
            }
        }

        /// <summary>
        /// Get the latest execution status of a given test
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void cmdLatestStatus_Click(object sender, EventArgs e)
        {
            using (WebClient l_objClient = new WebClient())
            {
                l_objClient.BaseAddress = txtBaseURL.Text;
                //Get the test case id from the selected line
                int l_intTestID = (int) tblTests.SelectedRows[0].Cells[0].Value;
                string l_strStatusURL = "tests/" + l_intTestID + "/status";
                try
                {
                    byte[] l_objResponse = l_objClient.UploadValues(l_strStatusURL, new NameValueCollection()
                   {
                       { "login", txtLogin.Text },
                       { "password", txtPassword.Text }
                   });
                    string l_strResult = System.Text.Encoding.UTF8.GetString(l_objResponse);
                    l_strResult = l_strResult.Replace("\"", "");
                    MessageBox.Show(l_strResult);
                }
                catch (WebException l_objException)
                {
                    MessageBox.Show(l_objException.Message);
                }
            }

        }

        private void tblTests_SelectionChanged(object sender, EventArgs e)
        {
            if (tblTests.SelectedRows.Count > 0)
            {
                cmdLatestStatus.Enabled = true;
            }
            else
            {
                cmdLatestStatus.Enabled = false;
            }
        }
    }
}
