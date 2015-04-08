using System;
using System.Windows.Forms;
using System.Collections.Generic;
using System.Collections.Specialized;

namespace CSharpClient
{
    public partial class frmStepsView : Form
    {
        /// <summary>
        /// Initialize the form and fill the datagrid with the list of test steps
        /// </summary>
        /// <param name="p_objLeave">Test steps Object retrieved through REST)</param>
        public frmStepsView(List<Step> p_lstTestSteps)
        {
            InitializeComponent();
            this.tblTestSteps.Rows.Clear();
            foreach (Step p_lstStep in p_lstTestSteps)
            {
                tblTestSteps.Rows.Add(p_lstStep.Id,
                    p_lstStep.Name,
                    p_lstStep.Action,
                    p_lstStep.Expected);
            }
        }

        /// <summary>
        /// Close the windows when click on leave button
        /// </summary>
        /// <param name="sender"></param>
        /// <param name="e"></param>
        private void cmdClose_Click(object sender, EventArgs e)
        {
            Close();
        }
    }
}
