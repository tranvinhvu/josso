package com.athirat.sso.agent;

import org.josso.agent.SSOPartnerAppConfig;

public class CustomSSOPartnerAppConfig extends SSOPartnerAppConfig {


	private static final long serialVersionUID = 8554317047217398612L;
	
	private String layout;
	private String formid;

	public String getLayout() {
		return layout;
	}

	public void setLayout(String layout) {
		this.layout = layout;
	}

	public String getFormid() {
		return formid;
	}

	public void setFormid(String formid) {
		this.formid = formid;
	}

	
	
}
