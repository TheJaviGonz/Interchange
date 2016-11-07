using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Interchange_v2.Startup))]
namespace Interchange_v2
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
