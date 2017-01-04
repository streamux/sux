{assign var=rootPath value=$skinPathList.root}
{assign var=title value=$groupData.document_name}
{assign var=headerPath value=$skinPathList.header}
{assign var=footerPath value=$skinPathList.footer}
{include file="$headerPath" title="$title :: 포트폴리오 - STREAMUX"}
포트폴리오 내용 

{include file="$footerPath"}
