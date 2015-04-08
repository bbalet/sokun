using System;

namespace CSharpClient
{
    /// <summary>
    /// Step (step action of a test case)
    /// </summary>
    public class Step
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string Action { get; set; }
        public string Expected { get; set; }
    }
}
