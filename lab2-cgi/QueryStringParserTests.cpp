#define DOCTEST_CONFIG_IMPLEMENT_WITH_MAIN
#include <doctest/doctest.h>

#include "QueryStringParser.h"

TEST_CASE("QueryStringParser tests")
{
    CHECK_EQ(GetQueryStringParameter("", "parameter"), "");
    CHECK_EQ(GetQueryStringParameter("name=", "name"), "");
    CHECK_EQ(GetQueryStringParameter("value=name", "name"), "");
    CHECK_EQ(GetQueryStringParameter("name=value", "name"), "value");
    CHECK_EQ(GetQueryStringParameter("name1=value1&name2=value2", "name2"), "value2");
}