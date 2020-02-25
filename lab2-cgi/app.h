#include <functional>
#include <iosfwd>
#include <optional>
#include <string>

class Application
{
public:
    using EnvironmentVariables = std::function<std::optional<std::string>(const char *)>;

    Application(std::ostream &out, EnvironmentVariables env);

    void sayHello() const;
    void printEnvironmentVariables() const;
    void printPersonInfo() const;
    void sarahRevere() const;

private:
    std::ostream &m_out;
    const EnvironmentVariables m_env;
};