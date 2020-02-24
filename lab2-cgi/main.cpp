#include "app.h"
#include <cstdlib>
#include <iostream>

using namespace std;

namespace
{
optional<string> environmentVariables(const char *name)
{
    if (auto s = getenv(name))
    {
        return string(s);
    }
    return nullopt;
}
} // namespace

int main()
{
    Application app{cout, environmentVariables};

    cout << "Content-Type: text/plain" << endl;
    cout << endl;

    app.sayHello();

    cout << endl;
    app.printEnvironmentVariables();

    return 0;
}