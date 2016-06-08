package com.athirat.sso.agent;

import javax.servlet.http.HttpServletRequest;

import org.josso.agent.SSOPartnerAppConfig;
import org.josso.agent.http.AbstractFrontChannelParametersBuilder;
import org.josso.gateway.SSONameValuePair;

public class CustomParametersBuilder extends AbstractFrontChannelParametersBuilder {
	@Override
	public SSONameValuePair[] buildParamters(SSOPartnerAppConfig cfg, HttpServletRequest hreq) {			
		return new SSONameValuePair[] { new SSONameValuePair("layout", ((CustomSSOPartnerAppConfig)cfg).getLayout())
				, new SSONameValuePair("form_id", ((CustomSSOPartnerAppConfig)cfg).getFormid()) };
	}
}
