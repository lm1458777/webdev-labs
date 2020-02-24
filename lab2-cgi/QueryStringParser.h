#include <string>
#include <vector>
#include <optional>

std::string GetQueryStringParameter(const std::string &queryString, std::string_view parameterName);

class QueryParameters
{
public:
    explicit QueryParameters(const std::string &queryString);
    std::optional<std::string> value(std::string_view parameterName) const;

private:
    using NameAndValue = std::pair<std::string, std::string>;
    std::vector<NameAndValue> m_parameters;
};